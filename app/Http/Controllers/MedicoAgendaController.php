<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicoAgendaRequest;
use App\models\Consulta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MedicoAgendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin');
    }

    public function index(Request $request)
    {
        $medicoId = $request->medico; 
        $data = is_null($request->data)? date('Y-m-d', strtotime('now')) : $request->data;

        $horarios = [];
        if (!is_null($medicoId)) {            
            $horarios = Consulta::where('medico_id', $medicoId)
                                ->where('data', '>=', $data . ' 00:00:00')
                                ->where('data', '<=', $data . ' 23:59:00')
                                ->get();
        }
        // dd($horarios);

        $medicos = User::where('tipo', 'medico')
                ->orderBy('name')
                ->get();

        return view('medico_agenda.index', compact('horarios', 'medicos', 'data', 'medicoId'));
    }
    
    public function create()
    {
        $medicos = User::where('tipo', 'medico')
                ->orderBy('name')
                ->get();

        return view('medico_agenda.create', compact('medicos'));
    }

    public function store(MedicoAgendaRequest $request)
    {
        $validatedData = $request->validated();
        try {
            DB::beginTransaction();
            $dataInicio = date('Y-m-d', strtotime($validatedData['data_inicio']));
            $dataFim = date('Y-m-d', strtotime($validatedData['data_fim']));
            $horaInicio = date('H:i', strtotime($validatedData['hora_inicio']));
            $horaFim = date('H:i', strtotime($validatedData['hora_fim']));    
            
            $consultasCriadas = Consulta::where('medico_id', $validatedData['medico'])
                                        ->where('data', '>=', $dataInicio . ' ' . $horaInicio)
                                        ->where('data', '<=', $dataFim . ' ' . $horaFim)
                                        ->get();

            $consultas = [];
            for ($dia = 0; date('Y-m-d', strtotime('+' . $dia . ' days', strtotime($dataInicio))) <= $dataFim; $dia++) {
                $dataAgendamento = date('Y-m-d', strtotime('+' . $dia . ' days', strtotime($dataInicio)));
                $diaSemana = date('w', strtotime($dataAgendamento));

                if (in_array($diaSemana, $validatedData['dias'], true)) {
                    for ($minutes = 0; date('H:i', strtotime('+' . $minutes . ' minutes', strtotime($horaInicio))) < $horaFim; 
                        $minutes = $validatedData['intervalo_horario'] + $minutes
                    ) {
                        $horaAgendamento = date('H:i', strtotime('+' . $minutes . ' minutes', strtotime($horaInicio)));

                        if($consultasCriadas->contains('data', $dataAgendamento . ' ' . $horaAgendamento.':00')) {
                            Session::flash("error", "Não foi possivel cadastrar a agenda, pois alguns horarios já estão criados!");
                            return redirect()->back()->withInput();
                        }

                        $consulta = [
                            'medico_id' => $validatedData['medico'],
                            'data' => $dataAgendamento . ' ' . $horaAgendamento,
                        ];
                        array_push($consultas, $consulta);
                    }
                }
            }            
            Consulta::insert($consultas);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
        }
        Session::flash("success", "Agenda cadastrada com sucesso!");
        return redirect()->back();
    }
}