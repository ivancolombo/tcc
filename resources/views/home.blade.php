@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <iframe src="https://meet.jit.si/**NOMEDASALA**" style="border:0px #ffffff none;" name="Jitsi" scrolling="no" frameborder="0" marginheight="0px" marginwidth="0px" height="700px" width="100%" allowfullscreen allow='camera; microphone'></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
