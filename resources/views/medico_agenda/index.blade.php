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
        <div class="col-12 col-sm-9 col-md-8 col-lg-8 col-xl-5">
            @csrf
            @method('POST')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gerenciar Agenda</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('gerenciar/agenda') }}" method="get">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="medico">Médico</label>
                                <select name="medico" class="form-control @error('medico') is-invalid @enderror">
                                    <option value="">Selecione</option>
                                    @foreach ($medicos as $medico)
                                        <option value="{{ $medico->id }}"
                                            {{ $medico->id == $medicoId ? 'selected' : '' }}>
                                            {{ $medico->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="data">Data</label>
                                <input type="date" name="data" class="form-control" value="{{ $data }}">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
                        </div>
                    </form>
                    <table class="table table-borderless">
                        <thead>
                            <tr class="row">
                                <th colspan="2">Horarios</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (is_null($medicoId))
                                <tr class="row">
                                    <td colspan="2" class="col-12 text-center mt-1 mb-1">Selecione um médico</td>
                                </tr>
                            @else                            
                                @forelse ($horarios as $horario)
                                    <tr class="row">
                                        <td class="col-10 text-center bg-success mt-1 mb-1">
                                            {{ date('H:i', strtotime($horario->data)) }}
                                        </td>
                                        <td class="col-2 text-center">
                                            <a class="btn btn-danger btn-sm">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="row">
                                        <td colspan="2" class="col-12 text-center mt-1 mb-1">Nenhum horario cadastrado para esse dia</td>
                                    </tr>
                                @endforelse                                                        
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end"></div>
            </div>
        </div>
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

            @if (Session::has('error'))
                Command: toastr["error"]("{{ Session::get('error') }}")
            
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
