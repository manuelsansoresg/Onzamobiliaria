@extends('adminlte::page')

@section('title', 'Asignación de Asesores')

@section('content_header')
<section class="content-header">
    <h1>
        Bandeja de Asesores
        <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Seguimiento de Asesores</li>
    </ol>
</section>
@stop
@section('content')
<div class="content">
    <div class="row">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Seguimiento de Asesores</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               {{--  <div>
                    <a href="/admin/seguimiento-asesores/create" class="btn btn-success pull-right">
                        <i class="fas fa-plus-circle"></i> &nbsp; Nuevo
                    </a>
                </div> --}}
                <br><br>
                <div class="col-md-12">
                    @include('flash::message')
                </div>
                <table id="mobiliaria" class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Dirección</th>
                            <th> Easybroker </th>
                            <th></th>
                        </tr>
                    </thead>
                    @foreach ($property_assignments as $property_assignment)
                    <tbody>
                        <tr>
                            <td>{{ $property_assignment->id  }}</td>
                            <td>
                                Calle: {{ $property_assignment->street  }} No int: {{ $property_assignment->noInt  }} No ext: {{ $property_assignment->noExt  }}
                                Colonia: {{  $property_assignment->colonia }}
                            </td>
                            <td>
                                {{ $property_assignment->pass_easy_broker }}
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
                    @endforeach

                </table>
                <div class="col-md-12 text-center">

                </div>
            </div>

        </div>

    </div>
</div>
@stop

@section('js')
<script src="{{ asset('vendor/adminlte/plugins/datatable/js/responsive.js') }}"></script>
<script>
    $(function() {

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
    })
</script>
@stop