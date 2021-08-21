<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicoRequest;
use App\Models\Especialidade;
use App\Models\User;
use App\Services\CreateUser;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class MedicoController extends Controller
{
    public function index()
    {
        return view('medico.index');
    }

    public function list()
    {
        $medicos = User::with('medico', 'medico.especialidade')
                        ->where('tipo', 'medico')
                        ->get();

        return DataTables::of($medicos)->make(true);
    }

    public function create()
    {
        $especialidades = Especialidade::all();

        return view('medico.create', compact('especialidades'));
    }

    public function store(MedicoRequest $request, CreateUser $createUser)
    {
        $requestValidated = $request->validated();

        $user = $createUser->make($requestValidated['nome'], $requestValidated['email'], $requestValidated['password'], 'medico');

        $user->medico()->create([
            'telefone' => $requestValidated['telefone'],
            'especialidade_id' => $requestValidated['especialidade_id'],
            'crm' => $requestValidated['crm'],
            'foto' => 'foto',
        ]);

        Session::flash("success", "Médico {$user->name} cadastrado com sucesso!");

        return redirect('/medicos');
    }

    public function edit($id)
    {
        dd($id);
    }
}
