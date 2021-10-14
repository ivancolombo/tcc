@extends('adminlte::page')
@section('content_header')
    <div class="col-sm-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Administradores</li>
        </ol>
    </div>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Administradores</h3>
            <div class="card-tools">
                <a href="{{ url('gerenciar/administradores/novo') }}" class="btn btn-primary btn-sm">Novo</a>
            </div>
        </div>
        <div class="card-body">
            <table id="dataTable" class="display responsive nowrap table table-bordered table-hover dtr-inline w-100">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Tipo</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Tipo</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@stop
@section('js')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
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
                ajax: "{{ url('gerenciar/administradores/list') }}",
                columns: [{
                        data: 'name',
                        responsivePriority: 2,
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'tipo',
                        render: function(data, type, row, meta) {
                            return row.tipo === 'admin'? 'Administrador' : 'Assistente';
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        responsivePriority: 2,
                        render: function(data, type, row, meta) {
                            let campo = `<div class="d-flex justify-content-center">
                                            <a class="btn btn-primary btn-sm" href="administradores/${row.id}/editar" data-toggle="tooltip" data-placement="left" title="Editar">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
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
