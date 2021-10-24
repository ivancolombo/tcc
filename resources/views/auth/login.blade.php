@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="vh-100 row justify-content-center align-items-center">
            <div class="col-md-5">
                <div class="card p-4">
                    <div class="card-header text-center mb-4 bg-transparent">{{ __('LOGIN') }}</div>

                    <div class="card-body">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="form-group row">
                                    <div class="col-md-12 text-center">
                                        <small class="text-danger">{{ $error }}</small>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <form method="POST" action="{{ url('login') }}">
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="email" type="text" class="form-control" name="email"
                                        value="{{ old('email') }}" required placeholder="E-mail"
                                        autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required placeholder="Senha" autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary w-100">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <style>
        #app {
            background-image: url("/storage/login/imagem-login.webp");                 
            background-position: center;
            background-size: cover;            
        }
    </style>
@endsection
