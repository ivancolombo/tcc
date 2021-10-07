@extends('adminlte::page')
@section('content_header')
    <div class="col-sm-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="/gerenciar/administradores">Administradores</a></li>
            <li class="breadcrumb-item active">Novo</li>
        </ol>
    </div>
@stop
@section('content')
    <div class="d-flex justify-content-center">
        <form action="{{ url('gerenciar/administradores') }}" method="POST" enctype="multipart/form-data"
            class="col-12 col-sm-9 col-md-8 col-lg-8 col-xl-5">
            @csrf
            @method('POST')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Novo</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <select name="tipo" class="form-control @error('tipo') is-invalid @enderror">
                            <option value="">Selecione</option>
                            <option value="admin" {{ old('tipo') === 'admin'? 'selected' : '' }}>Administrador</option>
                            <option value="secretaria" {{ old('tipo') === 'secretaria'? 'selected' : '' }}>Secretária</option>
                        </select>
                        @error('tipo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror"
                            value="{{ old('nome') }}">
                        @error('nome')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}">
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
                        <input type="password" name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror">
                        @error('password_confirmation')
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
