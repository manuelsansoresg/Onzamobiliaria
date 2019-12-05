@extends('layouts.master')
@section('title', 'SEGUIMIENTO')
@section('content')

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-12 text-right">
            <a href="/admin/seguimiento/create" class="btn btn-success btn-sm  pull-right">
                <i class="fas fa-plus-circle"></i> &nbsp; Nuevo
            </a>
        </div>
        <div class="col-12 mt-3">
            @include('flash::message')
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 mt-3">
            <table id="mobiliaria" class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>DESCRIPCIÓN</th>
                        <th>STATUS</th>
                        <th></th>
                    </tr>
                </thead>                
                <tbody>
                    @foreach ($status_follows as $status_follow)
                    <tr>
                        <td>{{ $status_follow->id  }}</td>
                        <td>{{ $status_follow->description  }}</td>
                        <td>
                            @if($status_follow->status == 0)
                            <i class="fas fa-ban text-danger"></i>
                            <span>Inactivo</span>
                            @else
                            <i class="fas fa-ban text-success"></i>
                            <span>Activo</span>
                            @endif

                        </td>
                        <td>
                            {{ Form::open(['route' => ['seguimiento.destroy', $status_follow->id ],'class' => 'form-inline', 'method' => 'DELETE' ])}}
                            <a href="{{route('seguimiento.edit', $status_follow->id)}}" class="btn btn-primary btn-sm">
                                <i class="far fa-edit"></i>
                            </a>
                            @if($status_follow->status == 0)
                            <a href="/admin/seguimiento/status/{{ $status_follow->id }}/1" class="btn btn-success btn-sm">
                                <i class="fas fa-ban text-white"></i>
                            </a>
                            @else
                            <a href="/admin/seguimiento/status/{{ $status_follow->id }}/0" class="btn btn-warning btn-sm">
                                <i class="fas fa-ban"></i>
                            </a>
                            @endif
                            @role('admin')
                            <button onclick="return confirm('¿Deseas eliminar el elemento?')" class="btn btn-danger btn-sm">
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
@endsection
@section('js')
<script>
    $(function() {

        $('#mobiliaria').DataTable({
            "bSearchable": true,
            "bFilter": true,
            responsive: true,
            "pageLength": 5,
            'paging': true,            
            'lengthChange': false,            
            'searching': true,            
            'ordering': true,
            'info': true,
            'autoWidth': false,
            "scrollX": true,
            dom: 'Bfrtip',
            buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
            ],
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