<?php

namespace App\Http\Controllers;

use App\models\Consulta;

class MedicoConsultaController extends Controller
{
    public function index(int $id)
    {
        $consulta = Consulta::with('paciente', 'paciente.paciente', 'paciente.paciente.endereco')->find($id);

        return view('medico_consulta.index', compact('consulta'));
    }
}
