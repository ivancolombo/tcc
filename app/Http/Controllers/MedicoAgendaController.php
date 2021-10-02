<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicoAgendaRequest;
use App\models\Consulta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class MedicoAgendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:secretaria')->except('agendar', 'horarios');
    }

    public function index(Request $request)
    {
        $medicoId = $request->medico; 
        $data = is_null($request->data)? date('Y-m-d', strtotime('now')) : $request->data;

        $horarios = [];
        if (!is_null($medicoId)) {            
            $horarios = Consulta::with('paciente')
                                ->where('medico_id', $medicoId)
                                ->where('data', '>=', $data . ' 00:00:00')
                                ->where('data', '<=', $data . ' 23:59:00')
                                ->orderBy('data')
                                ->get();
        }

        $medicos = User::where('tipo', 'medico')
                ->orderBy('name')
                ->get();

        return view('medico_agenda.index', compact('horarios', 'medicos', 'data', 'medicoId'));
    }
    
    public function create(int $medicoId)
    {
        $medico = User::where('tipo', 'medico')
                        ->where('id', $medicoId)
                        ->first();

        return view('medico_agenda.create', compact('medico'));
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
        return redirect('/gerenciar/agenda?medico='.$validatedData['medico']);
    }

    public function destroy($id)
    {
        $consulta = Consulta::find($id);
        $horario = date('H:i', strtotime($consulta->data));
        $consulta->delete();

        Session::flash("success", "Horário {$horario} excluido com sucesso!");
        return redirect()->back();
    }

    public function desmarcarConsulta($id)
    {
        $consulta = Consulta::with('paciente.user')->find($id);
        $paciente = $consulta->paciente->user->name;

        $consulta->paciente_id = null;
        $consulta->descricao_paciente = null;
        $consulta->sala_id = null;
        $consulta->save();

        Session::flash("success", "Consulta do {$paciente} desmarcada com sucesso!");
        return redirect()->back();
    }

    public function viewRemoverHorarios(int $medicoId)
    {
        $medico = User::where('tipo', 'medico')
                        ->where('id', $medicoId)
                        ->first();

        return view('medico_agenda.delete', compact('medico'));
    }

    public function removerHorarios(MedicoAgendaRequest $request)
    {
        $validatedData = $request->validated();
        
        $consultas = Consulta::where('medico_id', $validatedData['medico'])
                              ->where('data', '>=', $validatedData['data_inicio'] . ' 00:00:00')
                              ->where('data', '<=', $validatedData['data_fim']. ' 23:59:00')
                              ->get();

        $consultasId = [];
        foreach ($consultas as $consulta) {
            $horaInicio = date('H:i', strtotime($validatedData['hora_inicio']));
            $horaFim = date('H:i', strtotime($validatedData['hora_fim']));  

            $diaSemana = date('w', strtotime($consulta->data));
            $horaConsulta = date('H:i', strtotime($consulta->data));
            
            if (in_array($diaSemana, $validatedData['dias'], true) && $horaConsulta >= $horaInicio && $horaConsulta <= $horaFim) {
                array_push($consultasId, $consulta->id);                
            }
        }

        if (count($consultasId) == 0) {
            Session::flash('error', 'Nenhum horario encontrado!');
            return redirect()->back()->withInput();
        }

        Consulta::whereIn('id', $consultasId)->delete();

        Session::flash("success", "Agenda atualizada com sucesso!");
        return redirect('/gerenciar/agenda?medico='.$validatedData['medico']);
    }

    public function horarios($medicoId, Request $request)
    {
        $data = is_null($request->data)? date('Y-m-d', strtotime('now')) : $request->data;
        
        $medico = User::find($medicoId);

        $horarios = Consulta::where('medico_id', $medicoId)
                              ->where('data', '>=', $data.' 00:00:00')
                              ->where('data', '<=', $data.' 23:59:00')
                              ->where('paciente_id', null)
                              ->orderBy('data')
                              ->get();                             

        return view('medico_agenda.paciente_agendar', compact('medico', 'horarios', 'data'));
    }

    public function agendar(int $id, Request $request)
    {        
        $consulta = Consulta::find($id);

        if (!is_null($consulta->paciente_id)) {
            Session::flash('error', 'Ops, este horario não está disponivel!');
            return redirect()->back();
        }

        $consulta->paciente_id = Auth::id();
        $consulta->descricao_paciente = $request->descricao;
        $consulta->sala_id = Hash::make($consulta->id.$consulta->paciente_id.$consulta->medico_id.$consulta->data.strtotime('now'));        
        $consulta->save();

        Session::flash('success', 'Consulta agendada com sucesso!');
        return redirect()->back();
    }
}
