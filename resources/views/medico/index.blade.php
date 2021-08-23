@extends('adminlte::page')
@section('content_header')
    <div class="col-sm-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Médicos</li>
        </ol>
    </div>
@stop
@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show text-center col-md-12" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Médicos</h3>
            <div class="card-tools">
                <a href="{{ url('/medicos/novo') }}" class="btn btn-primary btn-sm">Novo</a>
            </div>
        </div>
        <div class="card-body">
            <table id="dataTable" class="display responsive nowrap table table-bordered table-hover dtr-inline w-100">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Especialidade</th>
                        <th>CRM</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Especialidade</th>
                        <th>CRM</th>
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
                ajax: "{{ url('medicos/list') }}",
                columns: [                    
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'medico.especialidade.nome'
                    },
                    {
                        data: 'medico.crm'
                    },
                    {
                        data: null,                        
                        orderable: false,
                        render: function(data, type, row, meta) {                            
                            let campo = `<div>
                                            <a class="btn btn-primary btn-sm" href="medicos/${row.id}/editar">
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
                order: [0, 'asc']
            });
        });
    </script>
@stop
