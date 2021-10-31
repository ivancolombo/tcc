<?php

namespace App\Http\Controllers;

use App\models\Consulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class MedicoConsultaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.termo');
        $this->middleware('can:medico');
    }

    public function index(int $id)
    {
        $consulta = Consulta::with('paciente', 'paciente.paciente', 'paciente.paciente.endereco')->find($id);
        $this->authorize('permissao-consulta', $consulta);
        return view('medico_consulta.index', compact('consulta'));
    }

    public function historicoPaciente(int $pacienteId)
    {
        $consultas = Consulta::where('medico_id', Auth::id())
                            ->where('paciente_id', $pacienteId)
                            ->where('data', '<', date('Y-m-d H:i', strtotime("-60 minutes", strtotime("now"))))
                            ->orderBy('data')
                            ->get();

        return DataTables::of($consultas)->make(true);        
    }

    public function finalizarConsulta(int $id, Request $request)
    {
        $consulta = Consulta::find($id);        

        $consulta->update([
            'descricao_medico' => $request->observacao,
            'status' => true
        ]);
        
        Session::flash('success', 'Consulta finalizada!');

        return redirect('minha-agenda');
    }

    public function videoChamada(int $id)
    {
        $consulta = Consulta::find($id);
        $this->authorize('permissao-consulta', $consulta);
        return view('medico_consulta.video_chamada', compact('consulta'));
    }
}
