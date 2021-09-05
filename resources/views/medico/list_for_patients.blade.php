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
            <div class="row">
                @forelse ($users as $user)
                    <div class="col-12 col-sm-6 col-md-6 col-xl-4 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0"></div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-8">
                                        <h2 class="lead"><b>{{ $user->name }}</b></h2>
                                        <p class="text-muted text-sm mb-1"><b>Especialidade: </b> {{ $user->medico->especialidade->nome }} </p>
                                        <p class="text-muted text-sm mb-1"><b>Telefone: </b> 
                                            @php
                                                $mask = strlen($user->medico->telefone) === 11? "(%s%s) %s%s%s%s%s-%s%s%s%s" : "(%s%s) %s%s%s%s-%s%s%s%s";
                                            @endphp
                                            {{  vsprintf($mask, str_split($user->medico->telefone))  }} 
                                        </p>
                                        <p class="text-muted text-sm mb-1"><b>CRM: </b> {{ $user->medico->crm }} </p>
                                        {{-- <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-building"></i></span> Address: Demo Street 123,
                                                Demo
                                                City 04312, NJ</li>
                                            <li class="small">
                                                <span class="fa-li">
                                                    <i class="fas fa-lg fa-phone"></i>
                                                </span> Telefone: {{ $user->medico->telefone }}
                                            </li>
                                        </ul> --}}
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

                @endforelse
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            {{ $users->links() }}
        </div>
    </div>
@stop
