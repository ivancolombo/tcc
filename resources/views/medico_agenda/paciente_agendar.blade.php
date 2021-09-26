@extends('adminlte::page')
@section('content_header')
    <div class="col-sm-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/medicos">Médicos</a></li>
            <li class="breadcrumb-item active">Agendar - {{ $medico->name }}</li>
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
                    <h3 class="card-title">Agendar - {{ $medico->name }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('medicos/'.$medico->id.'/agendar') }}" method="get">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="data">Dia</label>
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
                                @forelse ($horarios as $key => $horario)
                                    <tr class="row pl-2">
                                        <td class="col-10 text-center mt-1 mb-1 @if (strtotime($horario->data) > strtotime('now')) bg-success @else bg-secondary @endif">
                                            {{ date('H:i', strtotime($horario->data)) }}
                                        </td>
                                        <td class="col-2 text-center">
                                            @if (strtotime($horario->data) > strtotime('now'))        
                                                <a data-toggle="tooltip" data-placement="left" title="Agendar">
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#modalAgendar{{ $key }}">
                                                        <i class="far fa-clock"></i>
                                                    </button>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @if (strtotime($horario->data) > strtotime('now')) 
                                        <div class="modal fade" id="modalAgendar{{ $key }}" tabindex="-1"
                                            aria-labelledby="modalAgendarLabel" aria-hidden="true">
                                            <form action="{{ url('medicos/agendar', $horario->id) }}" method="post">
                                                @csrf
                                                @method('patch')
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Agendar Consulta!</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h6><span class="text-bold">Horário:</span> {{ date('H:i', strtotime($horario->data)) }}</h6>
                                                            <div class="form-group">
                                                                <label for="descricao">Descrição</label>
                                                                <textarea name="descricao" class="form-control @error('descricao') is-invalid @enderror"></textarea>
                                                                @error('descricao')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-primary">Confirmar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                @empty
                                    <tr class="row">
                                        <td colspan="2" class="col-12 text-center mt-1 mb-1">Nenhum horario disponível para
                                            esse dia</td>
                                    </tr>
                                @endforelse
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
            $('[data-toggle="tooltip"]').tooltip();
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
