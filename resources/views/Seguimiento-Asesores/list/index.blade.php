@extends('adminlte::page')

@section('title', 'Asignación de Asesores')

@section('content_header')
<section class="content-header">
    <h1>
        Seguimiento de asesores
        <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="/admin/seguimiento-asesores"><i class="fa fa-dashboard"></i> Seguimiento de asesores</a></li>
        <li class="active">lista de llamadas</li>
    </ol>
</section>
@stop
@section('content')
<div class="content">
    <div class="row">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">lista de llamadas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div>
                    <a href="/admin/seguimiento-asesores/{{ $property_id }}/create" class="btn btn-success pull-right">
                        <i class="fas fa-plus-circle"></i> &nbsp; Nuevo
                    </a>
                </div>
                <br><br>
                <div class="col-md-12">
                    @include('flash::message')
                </div>
                <table id="mobiliaria" class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            
                            <th> Fecha </th>
                            <th>Nombre</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    @foreach ($property_assignments as $property_assignment)
                    <tbody>
                        <tr>
                            <td>
                            {{ date('Y-m-d', strtotime($property_assignment->date) ) }}
                            </td>
                            <td>
                                {{ $property_assignment->name }}
                            </td>
                            
                            <td>
                                {{ $property_assignment->description }}
                            </td>
                            
                            <td>
                                {{ Form::open(['route' => ['seguimiento-asesores.destroy', $property_assignment->id ],'class' => 'form-inline', 'method' => 'DELETE' ])}}
                                <a href="{{route('seguimiento-asesores.edit', $property_assignment->id)}}" class="btn btn-primary">
                                    <i class="far fa-edit"></i>
                                </a>
                                @if($property_assignment->status == 0)
                                <a href="/admin/seguimiento-asesores/status/{{ $property_assignment->id }}/1" class="btn btn-success">
                                    <i class="fas fa-ban text-white"></i>
                                </a>
                                @else
                                <a href="/admin/seguimiento-asesores/status/{{ $property_assignment->id }}/0" class="btn btn-warning">
                                    <i class="fas fa-ban"></i>
                                </a>
                                @endif
                                <button onclick="return confirm('¿Deseas eliminar el elemento?')" class="btn btn-danger">
                                    <i class="far fa-trash-alt"></i>
                                </button>


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