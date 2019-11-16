@extends('layouts.master')

@section('title', 'Asignación de Asesores')


@section('content')
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-12 text-right">
            <a href="/admin/seguimiento-asesores/create" class="btn btn-success btn-sm  pull-right">
                <i class="fas fa-plus-circle"></i> &nbsp; Nuevo
            </a>
        </div>
        <div class="col-12 mt-3">
            @include('flash::message')
        </div>
        <div class="col-12 mt-3">

            <table id="property_assigment" class="table table-bordered table-responsive">
                {{-- <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Dirección</th>
                            <th> Easybroker </th>
                            @role('admin')
                            <th>Numero de llamadas</th>
                            @endrole
                            <th></th>
                        </tr>
                    </thead>
                    @foreach ($property_assignments as $property_assignment)
                    <tbody>
                        @role('admin')
                        <tr class="{{ classAlert($property_assignment->id) }}">
                @else
                <tr>
                    @endrole
                    <td>{{ $property_assignment->id  }}</td>
                    <td>
                        Calle: {{ $property_assignment->street  }} No int: {{ $property_assignment->noInt  }} No ext: {{ $property_assignment->noExt  }}
                        Colonia: {{ $property_assignment->colonia }}
                    </td>
                    @role('admin')
                    <td>
                        {{ $property_assignment->pass_easy_broker }}
                    </td>
                    @endrole
                    <td>
                        {{ countCalls($property_assignment->id) }}

                    </td>

                    <td>
                        {{ Form::open(['route' => ['seguimiento-asesores.destroy', $property_assignment->id ],'class' => 'form-inline', 'method' => 'DELETE' ])}}
                        <a href="/admin/seguimiento-asesores/lista/{{ $property_assignment->id }}" class="btn btn-primary">
                            <i class="fas fa-phone-volume"></i>
                        </a>


                        {{ Form::close() }}
                    </td>

                </tr>
                </tbody>
                @endforeach --}}

            </table>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="{{ asset('vendor/adminlte/plugins/datatable/js/responsive.js') }}"></script>
<script src="{{ asset('js/admin.js') }}"></script>
<script>
    /*  $(function() {

        $('#mobiliaria').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false,
            "scrollX": true,
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
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
        })
    }) */
</script>
@stop