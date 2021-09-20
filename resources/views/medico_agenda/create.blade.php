@extends('adminlte::page')
@section('content_header')
    <div class="col-sm-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Gerenciar Agenda</li>
        </ol>
    </div>
@stop
@section('content')
    <div class="d-flex justify-content-center">
        <form action="{{ url('gerenciar/agenda') }}" method="POST" enctype="multipart/form-data"
            class="col-12 col-sm-9 col-md-8 col-lg-8 col-xl-5">
            @csrf
            @method('POST')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gerenciar Agenda</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="data_fim">Médico</label>
                        <select name="medico" class="form-control @error('medico') is-invalid @enderror">
                            <option value="">Selecione</option>
                            @foreach ($medicos as $medico)
                                <option value="{{ $medico->id }}">{{ $medico->name }}</option>
                            @endforeach
                        </select>
                        @error('medico')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="dias">Dias da semana</label>
                            <div class="form-group form-check mb-1">
                                <input type="checkbox" class="form-check-input @error('dias') is-invalid @enderror"
                                    id="domingo" value="0" name="dias[]" {{ in_array(0, old('dias', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="domingo">Domingo</label>
                            </div>
                            <div class="form-group form-check mb-1">
                                <input type="checkbox" class="form-check-input @error('dias') is-invalid @enderror"
                                    id="segunda" value="1" name="dias[]" {{ in_array(1, old('dias', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="segunda">Segunda</label>
                            </div>
                            <div class="form-group form-check mb-1">
                                <input type="checkbox" class="form-check-input @error('dias') is-invalid @enderror"
                                    id="terca" value="2" name="dias[]" {{ in_array(2, old('dias', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="terca">Terça</label>
                            </div>
                            <div class="form-group form-check mb-1">
                                <input type="checkbox" class="form-check-input @error('dias') is-invalid @enderror"
                                    id="quarta" value="3" name="dias[]" {{ in_array(3, old('dias', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="quarta">Quarta</label>
                            </div>
                            <div class="form-group form-check mb-1">
                                <input type="checkbox" class="form-check-input @error('dias') is-invalid @enderror"
                                    id="quinta" value="4" name="dias[]" {{ in_array(4, old('dias', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="quinta">Quinta</label>
                            </div>
                            <div class="form-group form-check mb-1">
                                <input type="checkbox" class="form-check-input @error('dias') is-invalid @enderror"
                                    id="sexta" value="5" name="dias[]" {{ in_array(5, old('dias', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="sexta">Sexta</label>
                            </div>
                            <div class="form-group form-check mb-1">
                                <input type="checkbox" class="form-check-input @error('dias') is-invalid @enderror"
                                    id="sabado" value="6" name="dias[]" {{ in_array(6, old('dias', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="sabado">Sábado</label>
                            </div>
                            @error('dias')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="data_inicio">De</label>
                                <input type="date" class="form-control @error('data_inicio') is-invalid @enderror"
                                    name="data_inicio" value="{{ old('data_inicio') }}">
                                @error('data_inicio')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="data_fim">Até</label>
                                <input type="date" class="form-control @error('data_fim') is-invalid @enderror"
                                    name="data_fim" value="{{ old('data_fim') }}">
                                @error('data_fim')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="hora_inicio">Inicio</label>
                                <input type="time" class="form-control @error('hora_inicio') is-invalid @enderror"
                                    name="hora_inicio" value="{{ old('hora_inicio') }}">
                                @error('hora_inicio')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="hora_fim">Fim</label>
                                <input type="time" class="form-control @error('hora_fim') is-invalid @enderror"
                                    name="hora_fim" value="{{ old('hora_fim') }}">
                                @error('hora_fim')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="intervalo_horario">Intervalo Horario</label>
                                <input type="number" class="form-control @error('intervalo_horario') is-invalid @enderror"
                                    name="intervalo_horario" value="{{ old('intervalo_horario') }}">
                                @error('intervalo_horario')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button class="btn btn-primary">Abrir</button>
                </div>
            </div>
        </form>
    </div>
@stop
@section('js')
    <script>
        $(document).ready(function() {
            @if (Session::has('success'))
                Command: toastr["success"]("{{ Session::get('success') }}")
            
                toastr.options = {
                closeButton: false,
                debug: false,
                newestOnTop: false,
                progressBar: false,
                positionClass: "toast-top-right",
                preventDuplicates: false,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                timeOut: "5000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut"
                }
            @endif
        });
    </script>
@stop
