<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicoRequest;
use App\Models\Especialidade;
use App\Models\User;
use App\Services\ServiceUser;
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

    public function store(MedicoRequest $request, ServiceUser $serviceUser)
    {
        $requestValidated = $request->validated();

        $user = $serviceUser->create($requestValidated['nome'], $requestValidated['email'], $requestValidated['password'], 'medico');

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
        $user = User::with('medico')->find($id);
        $especialidades = Especialidade::all();

        return view('medico.edit', compact('user', 'especialidades'));
    }

    public function update(int $id, MedicoRequest $request, ServiceUser $serviceUser)
    {
        $requestValidated = $request->validated();

        $user = $serviceUser->update($id, $requestValidated['nome'], $requestValidated['email'], isset($requestValidated['password']) ? $requestValidated['password'] : null);

        $user->medico()->update([
            'telefone' => $requestValidated['telefone'],
            'especialidade_id' => $requestValidated['especialidade_id'],
            'crm' => $requestValidated['crm'],
            'foto' => 'foto',
        ]);

        Session::flash("success", "Médico {$user->name} atualizado com sucesso!");

        return redirect('/medicos');
    }
}
