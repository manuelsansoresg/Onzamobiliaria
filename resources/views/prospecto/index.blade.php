@extends('layouts.master')
@section('title', 'PROSPECCION DE INMUEBLES')
@section('content')

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-12 text-right">
            <a href="/admin/prospecto/create" class="btn btn-success btn-sm  pull-right">
                <i class="fas fa-plus-circle"></i> &nbsp; Nuevo
            </a>
        </div>
        <div class="col-12 mt-3">
            @include('flash::message')
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-md-8  mt-3">
            <table id="portales" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th><span class="small font-weight-bold">NOMBRE</span></th>
                        <th><span class="small font-weight-bold">TELEFONO</span></th>
                        <th><span class="small font-weight-bold">OBSERVACIONES</span></th>
                        <th><span class="small font-weight-bold">ESTATUS</span></th>
                        <th style="width: 100px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($leads as $lead)
                    <tr>
                        <td><span class="small">{{ $lead->nombre}}</span> </td>
                        <td><span class="small">{{ $lead->phone}}</span> </td>
                        <td><span class="small">{{ $lead->observation}}</span> </td>


                        <td><span class="small">
                                @if($lead->status == 0)
                                <i class="fas fa-ban text-danger"></i>
                                <span>INACTIVO</span>
                                @else
                                <i class="fas fa-ban text-success"></i>
                                <span>ACTIVO</span>
                                @endif
                            </span>
                        </td>
                        <td>
                            {{ Form::open(['route' => ['prospecto.destroy', $lead->id ],'class' => 'form-inline', 'method' => 'DELETE' ])}}
                            <a href="{{route('prospecto.edit', $lead->id)}}" class="btn btn-primary">
                                <i class="far fa-edit"></i>
                            </a>
                            @if($lead->status == 0)
                            <a href="/admin/prospecto/status/{{ $lead->id }}/1" class="btn btn-success">
                                <i class="fas fa-ban text-white"></i>
                            </a>
                            @else
                            <a href="/admin/prospecto/status/{{ $lead->id }}/0" class="btn btn-warning">
                                <i class="fas fa-ban"></i>
                            </a>
                            @endif
                            <button onclick="return confirm('¿Deseas eliminar el elemento?')" class="btn btn-danger">
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
@endsection

@section('js')
<script>
    $(function() {

        $('#portales').DataTable({
            "bSearchable": true,
            "bFilter": true,
            responsive: true,
            "pageLength": 5,

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