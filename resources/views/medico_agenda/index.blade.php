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
                    <div class="card-tools">
                        @if (!is_null($medicoId))
                            <a href="{{ url('gerenciar/agenda/medico', $medicoId) }}" class="btn btn-info btn-sm">Excluir Horários</a>                            
                            <a href="{{ url('gerenciar/agenda/medico', $medicoId) }}" class="btn btn-primary btn-sm">Cadastrar Horários</a>                            
                        @endif
                    </div>
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
                            @if (is_null($medicoId))
                                <tr class="row">
                                    <td colspan="2" class="col-12 text-center mt-1 mb-1">Selecione um médico</td>
                                </tr>
                            @else
                                @forelse ($horarios as $key => $horario)
                                    <tr class="row pl-2">
                                        <td class="col-10 text-center mt-1 mb-1 @if (is_null($horario->paciente_id)) bg-success @else bg-secondary @endif">
                                            {{ date('H:i', strtotime($horario->data)) }}
                                            @if (!is_null($horario->paciente_id))
                                                - {{ $horario->paciente->user->name }}
                                            @endif
                                        </td>
                                        <td class="col-2 text-center">
                                            @if (strtotime($horario->data) > strtotime('now'))                                                                                           
                                                @if (!is_null($horario->paciente_id))
                                                    <a data-toggle="tooltip" data-placement="left" title="Desmarcar Consulta">
                                                        <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                            data-target="#modalDesmarcarConsulta{{ $key }}">
                                                            <i class="fas fa-minus-circle"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                                <a data-toggle="tooltip" data-placement="left" title="Excluir">
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#modalExclusao{{ $key }}">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @if (strtotime($horario->data) > strtotime('now')) 
                                        <div class="modal fade" id="modalExclusao{{ $key }}" tabindex="-1"
                                            aria-labelledby="modalExclusaoLabel" aria-hidden="true">
                                            <form action="{{ url('/gerenciar/agenda', $horario->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirmar exclusão!</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h6>Deseja excluir o horário {{ date('H:i', strtotime($horario->data)) }}?</h6>
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
                                        <div class="modal fade" id="modalExclusao{{ $key }}" tabindex="-1"
                                            aria-labelledby="modalExclusaoLabel" aria-hidden="true">
                                            <form action="{{ url('/gerenciar/agenda', $horario->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirmar exclusão!</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h6>Deseja excluir o horário {{ date('H:i', strtotime($horario->data)) }}?</h6>
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
                                    @if (!is_null($horario->paciente_id))
                                        <div class="modal fade" id="modalDesmarcarConsulta{{ $key }}" tabindex="-1"
                                            aria-labelledby="modalDesmarcarConsultaLabel" aria-hidden="true">
                                            <form action="{{ url('/gerenciar/agenda/'.$horario->id.'/desmarcar-consulta') }}" method="post">
                                                @csrf
                                                @method('patch')
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Desmarcar Consulta!</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h6>
                                                                Deseja desmarcar a consulta do {{ $horario->paciente->user->name }} as
                                                                {{ date('H:i', strtotime($horario->data)) }}?                                                            
                                                            </h6>
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
                                        <td colspan="2" class="col-12 text-center mt-1 mb-1">Nenhum horario cadastrado para
                                            esse dia</td>
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
