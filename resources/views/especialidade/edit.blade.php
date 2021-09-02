@extends('adminlte::page')
@section('content_header')
    <div class="col-sm-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="/gerenciar/especialidades">Especialidades</a></li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
    </div>
@stop
@section('content')
<div class="d-flex justify-content-center">
    <form action="{{ url('gerenciar/especialidades', $especialidade->id) }}" method="POST" enctype="multipart/form-data" class="col-12 col-sm-9 col-md-8 col-lg-8 col-xl-5">
        @csrf
        @method('PATCH')
        <input type="hidden" name="user_id" value="{{$especialidade->id}}">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Editar</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{old("nome", $especialidade->nome)}}">
                    @error('nome')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>                
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>
</div>
@stop
