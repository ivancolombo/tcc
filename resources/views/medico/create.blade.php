@extends('adminlte::page')
@section('content')
    <section class="content-header row">
        <div class="col-sm-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Médicos</a></li>
                <li class="breadcrumb-item active">Novo</li>
            </ol>
        </div>
    </section>
    <section id="form" class="d-flex justify-content-center row">
        <form action="" class="col-12 col-sm-9 col-md-8 col-lg-8 col-xl-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Novo</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror">
                        @error('nome')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror">
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
                        <label for="password">Comfirmar senha</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="text" name="telefone" class="form-control @error('telefone') is-invalid @enderror">
                        @error('telefone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="especialidade">Especialidade</label>
                        <input type="text" name="especialidade"
                            class="form-control @error('especialidade') is-invalid @enderror">
                        @error('especialidade')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="crm">CRM</label>
                        <input type="text" name="crm" class="form-control @error('crm') is-invalid @enderror">
                        @error('crm')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="foto"
                                    class="custom-file-input @error('foto') is-invalid @enderror">
                                <label class="custom-file-label">Selecione uma foto...</label>
                            </div>
                            @error('foto')
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
    </section>
@endsection
