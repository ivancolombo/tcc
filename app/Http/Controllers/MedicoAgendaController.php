<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicoAgendaRequest;
use App\models\Consulta;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MedicoAgendaController extends Controller
{
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

            $consultas = [];
            for ($dia = 0; date('Y-m-d', strtotime('+' . $dia . ' days', strtotime($dataInicio))) <= $dataFim; $dia++) {
                $dataAgendamento = date('Y-m-d', strtotime('+' . $dia . ' days', strtotime($dataInicio)));
                $diaSemana = date('w', strtotime($dataAgendamento));

                if (in_array($diaSemana, $validatedData['dias'], true)) {
                    for ($minutes = 0; date('H:i', strtotime('+' . $minutes . ' minutes', strtotime($horaInicio))) <= $horaFim; 
                        $minutes = $validatedData['intervalo_horario'] + $minutes
                    ) {
                        $horaAgendamento = date('H:i', strtotime('+' . $minutes . ' minutes', strtotime($horaInicio)));
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
