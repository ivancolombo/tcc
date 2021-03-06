@extends('adminlte::page')
@section('content_header')
    <div class="col-sm-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/gerenciar/medicos">Médicos</a></li>
            <li class="breadcrumb-item active">Novo</li>
        </ol>
    </div>
@stop
@section('content')
    <div class="d-flex justify-content-center">
        <form action="{{ url('gerenciar/medicos') }}" method="POST" enctype="multipart/form-data"
            class="col-12 col-sm-9 col-md-8 col-lg-8 col-xl-5">
            @csrf
            @method('POST')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Novo</h3>
                </div>
                <div class="card-body">
                    <div class="profile-pic-wrapper">
                        <div class="pic-holder">
                            <img id="profilePic" class="pic"
                                src="https://image.flaticon.com/icons/png/512/1695/1695213.png">

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
                            <input class="uploadProfileInput d-none" type="file" name="foto" id="newProfilePhoto"
                                accept="image/*">
                        </div>
                        @error('foto')
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
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="text" name="telefone"
                            class="celular form-control @error('telefone') is-invalid @enderror"
                            value="{{ old('telefone') }}">
                        @error('telefone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="especialidade_id">Especialidade</label>
                        <select name="especialidade_id"
                            class="form-control @error('especialidade_id') is-invalid @enderror">
                            <option value="">Selecione</option>
                            @foreach ($especialidades as $especialidade)
                                <option value="{{ $especialidade->id }}"
                                    {{ old('especialidade_id') == $especialidade->id ? 'selected' : '' }}>
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
                        <input type="text" name="crm" class="crm form-control @error('crm') is-invalid @enderror"
                            value="{{ old('crm') }}">
                        @error('crm')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="rqe_1">RQE</label>
                            <input type="number" name="rqe_1" class="rqe_1 form-control @error('rqe_1') is-invalid @enderror"
                                placeholder="RQE 1" value="{{old("rqe_1")}}">
                            @error('rqe_1')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-6">    
                            <label for="rqe_2" style="visibility: hidden;">RQE</label>                               
                            <input type="number" name="rqe_2" class="rqe_2 form-control @error('rqe_2') is-invalid @enderror"
                                placeholder="RQE 2" value="{{old("rqe_2")}}">
                            @error('rqe_2')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>
    </div>
@stop
