@extends('adminlte::page')
@section('content_header')
    <div class="col-sm-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/minha-agenda">Minha Agenda</a></li>
            <li class="breadcrumb-item active">Consulta</li>
        </ol>
    </div>
@stop
@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-12">
            <div id="meet"></div>
           {{-- <iframe src="https://meet.jit.si/{{str_replace('/', '', $consulta->sala_id)}}" style="border:0px #ffffff none;" name="Jitsi" scrolling="no" frameborder="0" marginheight="0px" marginwidth="0px" height="700px" width="100%" allowfullscreen allow='camera; microphone'></iframe> --}}
        </div>
    </div>
@endsection
@section('js')
    <script src='https://meet.jit.si/external_api.js'></script>
    <script>
        const domain = 'meet.jit.si';
        const options = {
            roomName: '{{str_replace('/', '', $consulta->sala_id)}}',
            width: '100%',
            height: 700,
            userInfo: {
                displayName: '{{ Auth::user()->name }}'
            },
            interfaceConfigOverwrite: {
                APP_NAME: 'Consulta',
                JITSI_WATERMARK_LINK: '',
            },

            parentNode: document.querySelector('#meet')
        };
        const api = new JitsiMeetExternalAPI(domain, options);
    </script>
@endsection
