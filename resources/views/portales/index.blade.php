@extends('layouts.master')
@section('title', 'FORMA DE PAGO')
@section('content')

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-12 text-right">
            <a href="/admin/portales/create" class="btn btn-success btn-sm  pull-right">
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
                        <th> <span class="small font-weight-bold">#</span></th>
                        <th> <span class="small font-weight-bold">DESCRIPCION</span> </th>
                        <th> <span class="small font-weight-bold">ESTATUS</span> </th>        
                        <th style="width: 60px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ads as $ad)
                    <tr>
                        <td><span class="small">{{ $ad->id  }}</span></td>
                        <td><span class="small">{{ $ad->description  }}</span></td>
                        <td><span class="small">
                            @if($ad->status == 0)
                                <i class="fas fa-ban text-danger"></i>
                                <span>Inactivo</span>
                            @else
                                <i class="fas fa-ban text-success"></i>
                                <span>Activo</span>
                            @endif        
                            </span>
                        </td>
                        <td>
                            {{ Form::open(['route' => ['portales.destroy', $ad->id ],'class' => 'form-inline', 'method' => 'DELETE' ])}}
                            <a href="{{route('portales.edit', $ad->id)}}" class="btn btn-sm btn-primary">
                                <i class="far fa-edit"></i>
                            </a>
                            @if($ad->status == 0)
                                <a href="/admin/portales/status/{{ $ad->id }}/1" class="btn btn-success">
                                    <i class="fas fa-ban text-white"></i>
                                </a>
                            @else
                                <a href="/admin/portales/status/{{ $ad->id }}/0" class="btn btn-warning">
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
                    </tr>
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