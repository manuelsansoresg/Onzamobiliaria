@extends('layouts.master')
@section('title', 'USUARIOS')
@section('content')

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-12 text-right">
            <a href="/admin/usuarios/create" class="btn btn-success btn-sm  pull-right">
                <i class="fas fa-plus-circle"></i> &nbsp; Nuevo
            </a>
        </div>
        <div class="col-12 mt-3">
            @include('flash::message')
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-md-8  mt-3">
            <table id="mobiliaria" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th> <span class="small font-weight-bold">#</span> </th>
                        <th> <span class="small font-weight-bold">NOMBRE</span> </th>
                        <th> <span class="small font-weight-bold">NICK</span> </th>
                        <th> <span class="small font-weight-bold">CORREO</span> </th>
                        <th> <span class="small font-weight-bold">EASY BROKER</span> </th>
                        <th style="width: 10px"></th>                        
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><span class="small"> {{ $user->id }} </span> </td>
                        <td><span class="small"> {{ $user->name }} </span> </td>
                        <td><span class="small"> {{ $user->username }} </span> </td>
                        <td><span class="small"> {{ $user->email }} </span> </td>
                        <td><span class="small"> {{ $user->easy_broker }} </span> </td>                       
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