<?php

namespace App\Http\Controllers;

use App\Http\Requests\EspecialidadeRequest;
use App\Models\Especialidade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class EspecialidadeController extends Controller
{
    public function index()
    {
        return view('especialidade.index');
    }

    public function list()
    {
        $especialidades = Especialidade::all();

        return DataTables::of($especialidades)->make(true);
    }

    public function create()
    {
        return view('especialidade.create');
    }

    public function store(EspecialidadeRequest $request)
    {
        $requestValidated = $request->validated();

        DB::beginTransaction();

        $especialidade = Especialidade::create([
            'nome' => $requestValidated['nome'],
        ]);

        DB::commit();
        
        Session::flash("success", "Especialidade {$especialidade->nome} cadastrada com sucesso!");

        return redirect('gerenciar/especialidades');
    }

    public function edit($id)
    {
        $especialidade = Especialidade::find($id);
        
        return view('especialidade.edit', compact('especialidade'));
    }

    public function update(int $id, EspecialidadeRequest $request)
    {
        $requestValidated = $request->validated();

        DB::beginTransaction();
        $especialidade = Especialidade::find($id);
        $especialidade->nome = $requestValidated['nome'];
        $especialidade->save();
        DB::commit();

        Session::flash("success", "Especialidade {$especialidade->nome} atualizada com sucesso!");

        return redirect('gerenciar/especialidades');
    }
}
