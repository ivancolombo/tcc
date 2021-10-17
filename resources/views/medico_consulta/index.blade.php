@extends('adminlte::page')
@section('content_header')
    <div class="col-sm-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/minha-agenda">Minha Agenda</a></li>
            <li class="breadcrumb-item active">Dados da Consulta</li>
        </ol>
    </div>
@stop
@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-12">
            <form action="{{ url('/minha-agenda', $consulta->id) }}" method="POST">
                @csrf
                @method('patch')
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Dados da Consulta</h3>
                        <div class="card-tools">
                            <a target="_blank" href="{{ url('minha-agenda/' . $consulta->id . '/video-chamada') }}"
                                class="btn btn-success btn-sm">Iniciar chamada</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6 col-xl-4">
                                <h2 class="lead"><b>{{ $consulta->paciente->name }}</b></h2>
                                <p class="text-muted text-sm mb-1"><b>Horário: </b>
                                    {{ date('H:i', strtotime($consulta->data)) }} </p>
                                <p class="text-muted text-sm mb-1"><b>E-mail: </b> {{ $consulta->paciente->email }} </p>
                                <p class="text-muted text-sm mb-1"><b>Telefone: </b>
                                    {{ $consulta->paciente->paciente->getTelefone() }} </p>
                                <p class="text-muted text-sm mb-1"><b>CPF: </b>
                                    {{ $consulta->paciente->paciente->getCpf() }}
                                </p>
                            </div>
                            <div class="col-12 col-md-6 col-xl-4">
                                <p class="text-muted text-sm mb-1"><b>Estado: </b>
                                    {{ $consulta->paciente->paciente->endereco->estado }} </p>
                                <p class="text-muted text-sm mb-1"><b>Cidade: </b>
                                    {{ $consulta->paciente->paciente->endereco->cidade }} </p>
                                <p class="text-muted text-sm mb-1"><b>Bairro: </b>
                                    {{ $consulta->paciente->paciente->endereco->bairro }} </p>
                                <p class="text-muted text-sm mb-1"><b>Rua: </b>
                                    {{ $consulta->paciente->paciente->endereco->cidade }} </p>
                                <p class="text-muted text-sm mb-1"><b>CEP: </b>
                                    {{ $consulta->paciente->paciente->endereco->getCep() }} </p>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 col-xl-8">
                                <p class="text-muted text-sm mb-1"><b>Descrição: </b> </p>
                                <p>{{ $consulta->descricao_paciente ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12 col-xl-8">
                                <label for="observacao" class="text-muted text-sm">Observação:</label>
                                <textarea class="form-control" id="observacao" name="observacao" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="accordion col-12" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left" type="button"
                                                data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                Histórico de consultas
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseOne" class="collapse p-4" aria-labelledby="headingOne"
                                        data-parent="#accordionExample">
                                        <table id="dataTable"
                                            class="display responsive nowrap table table-bordered table-hover dtr-inline w-100">
                                            <thead>
                                                <tr>
                                                    <th>Data</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Data</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#finalizarConsulta">Finalizar consulta</button>
                    </div>
                </div>

                <div class="modal fade" id="finalizarConsulta" tabindex="-1" aria-labelledby="finalizarConsultaLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Finalizar Consulta!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h6>Deseja finalizar a consulta?</h6>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Confirmar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modalDetalhes" tabindex="-1" aria-labelledby="modalDetalhesTitulo"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDetalhesTitulo"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mt-2">
                            <div class="col-12">
                                <p class="text-muted text-sm mb-1"><b>Descrição Paciente: </b> </p>
                                <p id="descricao_paciente"></p>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <p class="text-muted text-sm mb-1"><b>Descrição Médico: </b> </p>
                                <p id="descricao_medico"></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            let table = $('#dataTable').DataTable({
                language: {
                    sEmptyTable: "Nenhum registro encontrado",
                    sInfo: "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    sInfoEmpty: "Mostrando 0 até 0 de 0 registros",
                    sInfoFiltered: "(Filtrados de _MAX_ registros)",
                    sInfoPostFix: "",
                    sInfoThousands: ".",
                    sLengthMenu: "_MENU_ resultados por página",
                    sLoadingRecords: "Carregando...",
                    sProcessing: "Processando...",
                    sZeroRecords: "Nenhum registro encontrado",
                    sSearch: "Pesquisar",
                    oPaginate: {
                        sNext: "Próximo",
                        sPrevious: "Anterior",
                        sFirst: "Primeiro",
                        sLast: "Último"
                    },
                    oAria: {
                        sSortAscending: ": Ordenar colunas de forma ascendente",
                        sSortDescending: ": Ordenar colunas de forma descendente"
                    },
                    decimal: ",",
                    thousands: ".",
                },
                responsive: {
                    details: {
                        type: 'column'
                    }
                },
                processing: true,
                serverSide: true,
                ajax: "{{ url('minha-agenda/historico-paciente', $consulta->paciente_id) }}",
                columns: [{
                        data: 'data'
                    },
                    {
                        data: null,
                        orderable: false,
                        render: function(data, type, row, meta) {
                            let campo = `<div class="d-flex justify-content-center">                                        
                                        <button type="button" class="btn btn-primary btn-sm detalhes" data-toggle="tooltip" data-placement="left" title="Detalhes">
                                            <i class="fas fa-plus"></i>
                                        </button>                                        
                                    </div>`;

                            return campo;
                        }
                    },
                ],
                visicolumnDefs: [{
                    className: 'dtr-control',
                    orderable: false,
                    targets: 1
                }],
                order: [0, 'asc'],
                initComplete: function(settings, json) {
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });

            $('#dataTable tbody').on('click', '.detalhes', function() {
                let data = table.row($(this).parents('tr')).data();

                $('#modalDetalhesTitulo').text('Detalhes consulta dia ' + data.data);
                $('#descricao_paciente').text(data.descricao_paciente ?? '-');
                $('#descricao_medico').text(data.descricao_medico ?? '-');

                $('#modalDetalhes').modal('show');
            });

        });
    </script>
@stop
