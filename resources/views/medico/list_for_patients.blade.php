@extends('adminlte::page')
@section('content_header')
    <div class="col-sm-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Médicos</li>
        </ol>
    </div>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Médicos</h3>
        </div>
        <div class="card-body">
            <form class="row d-flex align-items-end">
                <h6 class="col-12">Buscar por:</h6>
                <div class="form-group col-xl-3 col-lg-4 col-md-4">
                    <label for="especialidade">Especialidade</label>
                    <select name="especialidade" class="form-control">
                        <option value="">Todos</option>
                        @foreach ($especialidades as $especialidade)
                            <option value="{{ $especialidade->id }}" 
                                @php
                                    if (isset($dataSearch['especialidade']) && $dataSearch['especialidade'] == $especialidade->id) {
                                        echo 'selected';
                                    }
                                @endphp                                
                            >
                                {{ $especialidade->nome }}
                            </option>                            
                        @endforeach
                    </select>                    
                </div>
                <div class="form-group col-xl-3 col-lg-4 col-md-4">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" class="form-control" value="{{ $dataSearch['nome']?? '' }}">
                </div>
                <div class="form-group col-xl-3 col-lg-4 col-md-4">
                    <button class="btn btn-primary">Buscar</button>
                    <a href="{{ url('/medicos') }}" class="btn btn-link">Limpar filtro</a>
                </div>
            </form>
            <hr>
            <div class="row pt-1 d-flex justify-content-center">
                @forelse ($users as $user)
                    <div class="col-12 col-sm-6 col-md-6 col-xl-4 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0"></div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-8">
                                        <h2 class="lead"><b>{{ $user->name }}</b></h2>
                                        <p class="text-muted text-sm mb-1"><b>Especialidade: </b> {{ $user->medico->especialidade->nome }} </p>
                                        <p class="text-muted text-sm mb-1"><b>E-mail: </b> {{  $user->email }} </p>
                                        <p class="text-muted text-sm mb-1"><b>Telefone: </b> {{  $user->medico->getTelefone()  }} </p>
                                        <p class="text-muted text-sm mb-1"><b>CRM: </b> {{ $user->medico->crm }} </p>
                                        @if ($user->medico->rqe_1 || $user->medico->rqe_2 )
                                            <p class="text-muted text-sm mb-1"><b>RQE: </b> 
                                                {{ (!is_null($user->medico->rqe_1) && !is_null($user->medico->rqe_2)) ? $user->medico->rqe_1 .' - '. $user->medico->rqe_2 :  $user->medico->rqe_1 . $user->medico->rqe_2}} 
                                            </p>                                            
                                        @endif
                                    </div>
                                    <div class="col-4 text-center">
                                        <img src="{{ $user->medico->getFoto() }}"
                                            alt="{{ $user->name }}" class="img-circle img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <a href="#" class="btn btn-sm btn-primary">
                                        <i class="fas fa-user"></i> Perfil
                                    </a>
                                </div>
                            </div>
                        </div>                        
                    </div>
                @empty
                    <h4>Nenhum médico encontrado!</h4>
                @endforelse
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            {{ $users->appends($dataSearch)->links() }}
        </div>
    </div>
@stop
