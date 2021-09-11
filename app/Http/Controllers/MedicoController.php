<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicoRequest;
use App\Models\Especialidade;
use App\Models\User;
use App\Services\ServiceUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class MedicoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin');
    }
    
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

        $foto = null;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('fotos');
        }

        DB::beginTransaction();
        $user = $serviceUser->create($requestValidated['nome'], 
                                    $requestValidated['email'], 
                                    $requestValidated['password'], 
                                    'medico'
                                );

        $user->medico()->create([
            'telefone' => $requestValidated['telefone'],
            'especialidade_id' => $requestValidated['especialidade_id'],
            'crm' => $requestValidated['crm'],
            'rqe_1' => $requestValidated['rqe_1'],
            'rqe_2' => $requestValidated['rqe_2'],
            'foto' => $foto,
        ]);
        DB::commit();
        
        Session::flash("success", "Médico {$user->name} cadastrado com sucesso!");

        return redirect('gerenciar/medicos');
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

        $foto = null;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('fotos');
        }

        DB::beginTransaction();
        $user = $serviceUser->update($id, 
                                    $requestValidated['nome'], 
                                    $requestValidated['email'], 
                                    isset($requestValidated['status']), 
                                    isset($requestValidated['password']) ? $requestValidated['password'] : null,
                                    null                                
                                    );

        if (is_null($foto)) {
            $medicoDados = [
                'telefone' => $requestValidated['telefone'],
                'especialidade_id' => $requestValidated['especialidade_id'],
                'rqe_1' => $requestValidated['rqe_1'],
                'rqe_2' => $requestValidated['rqe_2'],
                'crm' => $requestValidated['crm'],
            ];
        } else {
            $medicoDados = [
                'telefone' => $requestValidated['telefone'],
                'especialidade_id' => $requestValidated['especialidade_id'],
                'crm' => $requestValidated['crm'],
                'rqe_1' => $requestValidated['rqe_1'],
                'rqe_2' => $requestValidated['rqe_2'],
                'foto' => $foto
            ];
        }

        $user->medico()->update($medicoDados);
        DB::commit();

        Session::flash("success", "Médico {$user->name} atualizado com sucesso!");

        return redirect('gerenciar/medicos');
    }

    public function listForPatients(Request $request, User $user)
    {
        $dataSearch = $request->all();

        $especialidades = Especialidade::all();

        $users = $user->search('medico', $dataSearch);

        return view('medico.list_for_patients', compact('users', 'especialidades', 'dataSearch'));
    }
}
