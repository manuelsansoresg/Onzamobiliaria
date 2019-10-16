@extends('adminlte::page')

@section('title', 'Propiedad')

@section('content_header')
<section class="content-header">
    <h1>
        Propiedad
        <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Propiedad</li>
    </ol>
</section>
@stop
@section('content')
<div class="content">
    <div class="row">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Propiedad</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div>
                    <a href="/admin/propiedad/create" class="btn btn-app pull-right">
                        <i class="fa fa-plus"></i> Nuevo
                    </a>
                </div>
                <div class="col-md-12">
                    @include('flash::message')
                </div>
                <table id="mobiliaria" class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Descripción</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    @foreach ($properties as $property)
                    <tbody>
                        <tr>
                            <td>{{ $property->id  }}</td>
                            <td>{{ $property->description  }}</td>
                            <td>
                                @if($property->status == 0)
                                <i class="fas fa-ban text-danger"></i>
                                <span>Inactivo</span>
                                @else
                                <i class="fas fa-ban text-success"></i>
                                <span>Activo</span>
                                @endif

                            </td>
                            <td>
                                {{ Form::open(['route' => ['propiedad.destroy', $property->id ],'class' => 'form-inline', 'method' => 'DELETE' ])}}
                                <a href="{{route('propiedad.edit', $property->id)}}" class="btn btn-primary">
                                    <i class="far fa-edit"></i>
                                </a>
                                @if($property->status == 0)
                                <a href="/admin/propiedad/status/{{ $property->id }}/1" class="btn btn-success">
                                    <i class="fas fa-ban text-white"></i>
                                </a>
                                @else
                                <a href="/admin/propiedad/status/{{ $property->id }}/0" class="btn btn-warning">
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