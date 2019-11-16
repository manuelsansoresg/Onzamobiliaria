@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
<section class="content-header">
    <h1>
        Usuarios
        <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Usuarios</li>
    </ol>
</section>
@stop
@section('content')
<div class="content">
    <div class="row">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Usuarios</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div>
                    <a href="/admin/usuarios/create" class="btn btn-success pull-right">
                        <i class="fas fa-plus-circle"></i> &nbsp; Nuevo
                    </a>
                </div>
                <br><br>
                <div class="col-md-12">
                    @include('flash::message')
                </div>
                <br>
                <br>
                <br>
                <table id="mobiliaria" class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>NOMBRE</th>
                            <th>NICK</th>
                            <th>CORREO</th>
                            <th>EASY BROKER</th>
                            <th></th>
                        </tr>
                    </thead>
                    @foreach ($users as $user)
                    <tbody>
                        <tr>
                            <td>{{ $user->id  }}</td>
                            <td>{{ $user->name  }}</td>
                            <td>{{ $user->username  }}</td>
                            <td>{{ $user->email  }}</td>
                            <td>{{ $user->easy_broker  }}</td>

                            <td>
                                {{ Form::open(['route' => ['usuarios.destroy', $user->id ],'class' => 'form-inline', 'method' => 'DELETE' ])}}
                                <a href="{{route('usuarios.edit', $user->id)}}" class="btn btn-primary">
                                    <i class="far fa-edit"></i>
                                </a>

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