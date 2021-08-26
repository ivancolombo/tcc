<?php

namespace App\Http\Controllers;

use App\Http\Requests\PacienteRequest;
use App\Models\User;
use App\Services\ServiceUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class PacienteController extends Controller
{
    public function index()
    {
        return view('paciente.index');
    }

    public function list()
    {
        $pacientes = User::with('paciente')
                    ->where('tipo', 'paciente')
                    ->get();         

        return DataTables::of($pacientes)->make(true);
    }

    public function create()
    {
        return view('paciente.create');
    }

    public function store(PacienteRequest $request, ServiceUser $serviceUser)
    {
        $requestValidated = $request->validated();

        $foto = null;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('fotos');
        }

        DB::beginTransaction();
        $user = $serviceUser->create($requestValidated['nome'], $requestValidated['email'], $requestValidated['password'], 'paciente');

        $user->paciente()->create([
            'telefone' => $requestValidated['telefone'],
            'data_nascimento' => $requestValidated['data_nascimento'],
            'cpf' => $requestValidated['cpf'],
            'foto' => $foto,
        ]);
        DB::commit();

        Session::flash("success", "Paciente {$user->name} cadastrado com sucesso!");

        return redirect('/pacientes');
    }

    public function edit($id)
    {
        $user = User::with('paciente')->find($id);

        return view('paciente.edit', compact('user'));
    }

    public function update(int $id, PacienteRequest $request, ServiceUser $serviceUser)
    {
        $requestValidated = $request->validated();

        $foto = null;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('fotos');
        }

        DB::beginTransaction();
        $user = $serviceUser->update($id, $requestValidated['nome'], $requestValidated['email'], isset($requestValidated['password']) ? $requestValidated['password'] : null);

        if (is_null($foto)) {
            $pacienteDados = [
                'telefone' => $requestValidated['telefone'],
                'data_nascimento' => $requestValidated['data_nascimento'],
                'cpf' => $requestValidated['cpf'],
            ];
        } else {
            $pacienteDados = [
                'telefone' => $requestValidated['telefone'],
                'data_nascimento' => $requestValidated['data_nascimento'],
                'cpf' => $requestValidated['cpf'],
                'foto' => $foto
            ];
        }

        $user->paciente()->update($pacienteDados);
        DB::commit();

        Session::flash("success", "Paciente {$user->name} atualizado com sucesso!");

        return redirect('/pacientes');
    }
}
