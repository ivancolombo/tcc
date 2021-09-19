<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdministradorRequest;
use App\Models\User;
use App\Services\ServiceUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class AdministradorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin');
    }

    public function index()
    {
        return view('administrador.index');
    }

    public function list()
    {
        $user = User::where('tipo', 'admin')->orWhere('tipo', 'secretaria')->get();         

        return DataTables::of($user)->make(true);
    }

    public function create()
    {
        return view('administrador.create');
    }

    public function store(AdministradorRequest $request, ServiceUser $serviceUser)
    {
        $requestValidated = $request->validated();

        DB::beginTransaction();
        $user = $serviceUser->create($requestValidated['nome'], 
                                     $requestValidated['email'], 
                                     $requestValidated['password'], 
                                     $requestValidated['tipo']         
                                    );
        DB::commit();

        Session::flash("success", "Usuario {$user->name} cadastrado com sucesso!");

        return redirect('gerenciar/administradores');
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('administrador.edit', compact('user'));
    }

    public function update(int $id, AdministradorRequest $request, ServiceUser $serviceUser)
    {
        $requestValidated = $request->validated();
        
        DB::beginTransaction();
        $user = $serviceUser->update($id, 
                                    $requestValidated['nome'], 
                                    $requestValidated['email'], 
                                    isset($requestValidated['status']), 
                                    isset($requestValidated['password']) ? $requestValidated['password'] : null,
                                    $requestValidated['tipo']
                                );
        DB::commit();

        Session::flash("success", "Usuario {$user->name} atualizado com sucesso!");

        return redirect('gerenciar/administradores');
    }
}
