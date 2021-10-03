@extends('adminlte::page')
@section('content_header')
    <div class="col-sm-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/minha-agenda">Minha Agenda</a></li>
            <li class="breadcrumb-item active">Dados da Consulta</li>
        </ol>
    </div>
@stop
@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Dados da Consulta</h3>
                    <div class="card-tools">
                        <a href="" class="btn btn-success btn-sm">Iniciar chamada</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <h2 class="lead"><b>{{ $consulta->paciente->name }}</b></h2>
                            <p class="text-muted text-sm mb-1"><b>Horário: </b> {{ date('H:i', strtotime($consulta->data)) }} </p>
                            <p class="text-muted text-sm mb-1"><b>E-mail: </b> {{ $consulta->paciente->email }} </p>
                            <p class="text-muted text-sm mb-1"><b>Telefone: </b> {{ $consulta->paciente->paciente->getTelefone() }} </p>
                            <p class="text-muted text-sm mb-1"><b>CPF: </b> {{ $consulta->paciente->paciente->getCpf() }} </p>
                        </div>
                        <div class="col-4">
                            <p class="text-muted text-sm mb-1"><b>Estado: </b> {{ $consulta->paciente->paciente->endereco->estado }} </p>
                            <p class="text-muted text-sm mb-1"><b>Cidade: </b> {{ $consulta->paciente->paciente->endereco->cidade }} </p>
                            <p class="text-muted text-sm mb-1"><b>Bairro: </b> {{ $consulta->paciente->paciente->endereco->bairro }} </p>
                            <p class="text-muted text-sm mb-1"><b>Rua: </b> {{ $consulta->paciente->paciente->endereco->cidade }} </p>
                            <p class="text-muted text-sm mb-1"><b>CEP: </b> {{ $consulta->paciente->paciente->endereco->getCep() }} </p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Finalizar consulta</button>
                </div>
            </div>
        </div>
    </div>
@endsection
