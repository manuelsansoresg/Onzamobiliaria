@extends('layouts.master')

@section('title', 'CLIENTES')

@section('content')
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-12 mt-3">
            @include('flash::message')
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h5 class="mr-auto">LISTADO DE CLIENTES</h5>
                <div>
                    <a href="/admin/clientes/create" class="btn btn-success btn-sm  pull-right"><i class="fas fa-plus-circle"></i> AGREGAR</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mt-3">
                <div class="col-12 mt-3">
                    <table id="mobiliaria" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th> <span class="small font-weight-bold">NOMBRE</span> </th>
                                <th> <span class="small font-weight-bold">CORREO</span> </th>
                                <th> <span class="small font-weight-bold">TELÉFONO</span> </th>
                                <th> <span class="small font-weight-bold">CLAVE INTERNA</span> </th>
                                <th> <span class="small font-weight-bold">PROPIETARIO</span> </th>

                                <th style="width: 60px"></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($clients as $client)
                            <tr>
                                <td> <span class="small"> {{ $client->nombre }} </span> </td>
                                <td> <span class="small"> {{ $client->correo }} </span> </td>
                                <td> <span class="small"> {{ $client->telefono }} </span> </td>
                                <td> <span class="small"> {{ $client->clave_interna }} </span> </td>
                                <td> <span class="small"> {!! ($client->is_property==1)? '<span class="badge bg-green">Sí</span>' : '<span class="badge bg-red">No</span>' !!} </span> </td>
                                <td>

                                    {{ Form::open(['route' => ['clientes.destroy', $client->id ],'class' => 'form-inline', 'method' => 'DELETE' ])}}
                                    <a href="{{route('clientes.edit', $client->id)}}" class="btn btn-sm btn-primary">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <button onclick="return confirm('¿Deseas eliminar el elemento?')" class="btn btn-danger btn-sm ml-1">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                    {{ Form::close() }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- <script src="{{ asset('vendor/adminlte/plugins/datatable/js/responsive.js') }}"></script> -->
<script>
    $(function() {
        $('#mobiliaria thead tr').clone(true).appendTo('#mobiliaria thead');

        $('#mobiliaria thead tr:eq(1) th').each(function(i) {

            var title = $(this).text();
            var ocultar = ($('#mobiliaria thead tr:eq(1) th').length == i + 1) ? 'd-none' : '';

            $(this).html('<input class="' + ocultar + ' form-control form-control-sm" type="text" placeholder="Buscar " />');

            $('input', this).on('keyup change', function() {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        });

        var table = $('#mobiliaria').DataTable({

            responsive: true,
            "pageLength": 10,

            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "BUSCAR:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
        });
    })
</script>
@endsection