@extends('adminlte::page')
@section('content_header')
    <div class="col-sm-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="/medicos">Médicos</a></li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
    </div>
@stop
@section('content')
<div class="d-flex justify-content-center">
    <form action="{{ url('medicos', $user->id) }}" method="POST" enctype="multipart/form-data" class="col-12 col-sm-9 col-md-8 col-lg-8 col-xl-5">
        @csrf
        @method('PATCH')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Editar</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{old("nome", $user->name)}}">
                    @error('nome')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old("email", $user->email)}}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Confirmar senha</label>
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                    @error('password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" name="telefone" class="form-control @error('telefone') is-invalid @enderror" value="{{old("telefone", $user->medico->telefone)}}">
                    @error('telefone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="especialidade_id">Especialidade</label>                    
                    <select name="especialidade_id" class="form-control @error('especialidade_id') is-invalid @enderror">
                        <option value="">Selecione</option>
                        @foreach ($especialidades as $especialidade)
                            <option value="{{ $especialidade->id }}" {{old("especialidade_id", $user->medico->especialidade_id) == $especialidade->id? 'selected' : ''}}>
                                {{ $especialidade->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('especialidade_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="crm">CRM</label>
                    <input type="text" name="crm" class="form-control @error('crm') is-invalid @enderror" value="{{old("crm", $user->medico->telefone)}}">
                    @error('crm')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="foto">Foto</label>
                    <div class="input-group @error('foto') is-invalid @enderror">
                        <div class="custom-file">
                            <input type="file" name="foto" class="custom-file-input @error('foto') is-invalid @enderror">
                            <label class="custom-file-label">Selecione uma foto...</label>
                        </div>
                    </div>
                    @error('foto')
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
