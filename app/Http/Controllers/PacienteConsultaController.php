<?php

namespace App\Http\Controllers;

use App\models\Consulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PacienteConsultaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:paciente');
    }

    public function index(Request $request)
    {
        $data = is_null($request->data)? date('Y-m-d', strtotime('now')) : $request->data;

        $consultas = Consulta::with('medico', 'medico.medico', 'medico.medico.especialidade')
                             ->where('paciente_id', Auth::id())
                             ->where('data', '>=', $data.' 00:00:00')
                             ->where('data', '<=', $data.' 23:59:00')
                             ->get();

        $consulta = $consultas->first();

        return view('paciente_consulta.minhas_consultas', compact('consultas', 'data'));
    }

    public function videoChamada(int $id)
    {
        $consulta = Consulta::find($id);
        return view('paciente_consulta.video_chamada', compact('consulta'));
    }
}
