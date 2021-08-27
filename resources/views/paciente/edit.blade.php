@extends('adminlte::page')
@section('content_header')
    <div class="col-sm-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="/pacientes">Pacientes</a></li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
    </div>
@stop
@section('content')
<div class="d-flex justify-content-center">
    <form action="{{ url('pacientes', $user->id) }}" method="POST" enctype="multipart/form-data" class="col-12 col-sm-9 col-md-8 col-lg-8 col-xl-5">
        @csrf
        @method('PATCH')
        <input type="hidden" name="user_id" value="{{$user->id}}">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Editar</h3>
            </div>
            <div class="card-body">
                <div class="profile-pic-wrapper">
                    <div class="pic-holder">
                        <img id="profilePic" class="pic" src="{{$user->paciente->getFoto()}}">

                        <label for="newProfilePhoto" class="upload-file-block">
                            <div class="text-center">
                                <div class="mb-2">
                                    <i class="fa fa-camera fa-2x"></i>
                                </div>
                                <div class="text-uppercase">
                                    Selecione <br /> uma foto de perfil
                                </div>
                            </div>
                        </label>
                        <input class="uploadProfileInput d-none" type="file" name="foto" id="newProfilePhoto" accept="image/*">
                    </div>
                    @error('foto')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="status" name="status" {{ old("status", $user->status)? 'checked' : '' }}>
                    <label class="form-check-label" for="status">Ativo</label>
                </div>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{old("nome", $user->name)}}">
                    @error('nome')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="data_nascimento">Data de Nascimento</label>
                    <input type="date" name="data_nascimento" class="form-control @error('data_nascimento') is-invalid @enderror"
                        value="{{ old('data_nascimento', $user->paciente->data_nascimento) }}">
                    @error('data_nascimento')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div> 
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" class="cpf form-control @error('cpf') is-invalid @enderror"
                        value="{{ old('cpf', $user->paciente->cpf) }}">
                    @error('cpf')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" name="telefone" class="celular form-control @error('telefone') is-invalid @enderror" value="{{old("telefone", $user->paciente->telefone)}}">
                    @error('telefone')
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
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>
</div>
@stop
