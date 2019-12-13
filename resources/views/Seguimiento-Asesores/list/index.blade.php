@extends('layouts.master')

@section('title', 'Asignación de Asesores')


@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mt-3">
        <div class="col-12 col-md-8 ">
            <div class="col-12 mt-3">
                @include('flash::message')
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="mr-auto">SEGUIMIENTO DE LLAMADAS</h5>
                        <div>
                            <a href="/admin/seguimiento-asesores" class="btn btn-primary btn-sm  pull-right">
                                <i class="fas fa-arrow-circle-left"></i> REGRESAR
                            </a>
                            <a href="/admin/historico-seguimiento/create/{{ $id_assigment }}" class="btn btn-success btn-sm  pull-right">
                                <i class="fas fa-plus-circle"></i>AGREGAR
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-12 mt-3">
                        <table id="mobiliaria" class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th>FECHA</th>
                                    <th>ESTATUS</th>
                                    <th>OBSERVACIÓN</th>
                                    <th style="width: 150px;"></th>
                                </tr>
                            </thead>
                            @foreach ($property_assignments as $property_assignment)
                            <tbody>
                                <tr>
                                    <td>{{ date('Y-m-d', strtotime($property_assignment->fecha)) }}</td>
                                    <td>{{ $property_assignment->status }}</td>
                                    <td>{{ $property_assignment->observacion1  }}</td>
                                    <td>
                                        @role('admin')
                                        {{ Form::open(['route' => ['historico-seguimiento.destroy', $property_assignment->id ],'class' => 'form-inline', 'method' => 'DELETE' ])}}
                                        <a href="{{route('historico-seguimiento.edit', $property_assignment->id)}}" class="btn btn-primary">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <button onclick="return confirm('¿Deseas eliminar el elemento?')" class="btn btn-danger ml-1">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                        {{ Form::close() }}
                                        @endrole
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')

<script>
    $(function() {

        $('#mobiliaria').DataTable({
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