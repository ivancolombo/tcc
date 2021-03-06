<?php

namespace App\Http\Controllers;

use App\models\Consulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PacienteConsultaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.termo');
        $this->middleware('can:paciente');
    }

    public function index(Request $request)
    {
        $data = is_null($request->data)? date('Y-m-d', strtotime('now')) : $request->data;

        $consultas = Consulta::with('medico', 'medico.medico', 'medico.medico.especialidade')
                             ->where('paciente_id', Auth::id())
                             ->where('data', '>=', $data.' 00:00:00')
                             ->where('data', '<=', $data.' 23:59:00')
                             ->orderBy('data')
                             ->get();

        $consulta = $consultas->first();

        return view('paciente_consulta.minhas_consultas', compact('consultas', 'data'));
    }

    public function desmarcarConsulta($id)
    {
        $consulta = Consulta::with('medico')->find($id);

        $medico = $consulta->medico->name;

        $consulta->paciente_id = null;
        $consulta->descricao_paciente = null;
        $consulta->sala_id = null;
        $consulta->save();

        Session::flash("success", "Consulta com o {$medico} desmarcada com sucesso!");
        return redirect()->back();
    }

    public function videoChamada(int $id)
    {
        $consulta = Consulta::find($id);
        $this->authorize('permissao-consulta', $consulta);

        return view('paciente_consulta.video_chamada', compact('consulta'));
    }    
}
