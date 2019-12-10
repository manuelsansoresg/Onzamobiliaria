@extends('layouts.master')
@section('title', 'OPERACIONES')
@section('content')

<div class="container-fluid">
    <div class="row mt-3">        
        <div class="col-12 mt-3">
            @include('flash::message')
        </div>
    </div>
    <div class="row justify-content-center">        
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="mr-auto">LISTADO DE OPERACIONES</h5>
                        <div>
                            <a href="/admin/operaciones/create" class="btn btn-success btn-sm  pull-right"><i class="fas fa-plus-circle"></i> AGREGAR</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col-12">
                            <table id="mobiliaria" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th> <span class="small font-weight-bold">#</span></th>
                                        <th> <span class="small font-weight-bold">DESCRIPCION</span> </th>
                                        <th> <span class="small font-weight-bold">ESTATUS</span> </th>        
                                        <th style="width: 60px"></th>
                                    </tr>
                                </thead>
                                <tbody>                        
                                        @foreach ($operations as $operation)
                                    <tr>
                                        <td><span class="small">{{ $operation->id  }}</span></td>
                                        <td><span class="small">{{ $operation->description  }}</span></td>
                                        <td><span class="small">
                                            @if($operation->status == 0)
                                                <i class="fas fa-ban text-danger"></i>
                                                <span>Inactivo</span>
                                            @else
                                                <i class="fas fa-ban text-success"></i>
                                                <span>Activo</span>
                                            @endif        
                                            </span>
                                        </td>
                                        <td>
                                            {{ Form::open(['route' => ['operaciones.destroy', $operation->id ],'class' => 'form-inline', 'method' => 'DELETE' ])}}
                                            <a href="{{route('operaciones.edit', $operation->id)}}" class="btn btn-sm btn-primary">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            @if($operation->status == 0)
                                                <a href="/admin/operaciones/status/{{ $operation->id }}/1" class="btn btn-success">
                                                    <i class="fas fa-ban text-white"></i>
                                                </a>
                                            @else
                                                <a href="/admin/operaciones/status/{{ $operation->id }}/0" class="btn btn-warning">
                                                    <i class="fas fa-ban"></i>
                                                </a>
                                            @endif
                                            @role('admin')
                                                <button onclick="return confirm('¿Deseas eliminar el elemento?')" class="btn btn-danger btn-sm ml-1">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            @endrole
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
    </div>
</div>
@endsection

@section('js')
<script>
    $(function() {

        $('#mobiliaria').DataTable({
            "bSearchable": true,
            "bFilter": true,
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
        })
    })
</script>
@endsection