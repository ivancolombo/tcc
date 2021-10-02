@extends('adminlte::page')
@section('content_header')
    <div class="col-sm-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Minhas Consultas</li>
        </ol>
    </div>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Minhas Consultas</h3>
        </div>
        <div class="card-body">
            <form class="row d-flex align-items-end">
                <div class="form-group col-xl-3 col-lg-3 col-md-3">
                    <label for="data">Data</label>
                    <input type="date" name="data" class="form-control" value="{{ $data }}">
                </div>
                <div class="form-group col-xl-3 col-lg-4 col-md-4">
                    <button class="btn btn-primary">Buscar</button>
                </div>
            </form>
            <hr>
            <div class="row pt-1 d-flex justify-content-center">
                @forelse ($consultas as $consulta)
                    <div class="col-12 col-sm-6 col-md-6 col-xl-4 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0"></div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-8">
                                        <h2 class="lead"><b>{{ $consulta->paciente->name }}</b></h2>
                                        <p class="text-muted text-sm mb-1"><b>E-mail: </b> {{ $consulta->paciente->email }} </p>
                                        <p class="text-muted text-sm mb-1"><b>Telefone: </b> {{ $consulta->paciente->paciente->getTelefone() }} </p>
                                        <p class="text-muted text-sm mb-1"><b>Cidade: </b> {{ $consulta->paciente->paciente->endereco->cidade }} </p>
                                        <p class="text-muted text-sm mb-1"><b>CPF: </b> {{ $consulta->paciente->paciente->getCpf() }} </p>
                                    </div>
                                    <div class="col-4 text-center">
                                        <img src="{{ $consulta->paciente->paciente->getFoto() }}"
                                            alt="{{ $consulta->paciente->name }}" class="img-circle img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="text-muted text-sm mb-1"><b>Horario: </b> {{ date('H:i', strtotime($consulta->data)) }} </p>
                                    <a href="" class="btn btn-sm btn-success"> 
                                        <i class="fas fa-video mr-1"></i> Iniciar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h4>Nenhuma consulta encontrada!</h4>
                @endforelse
            </div>
        </div>
    </div>
@stop
