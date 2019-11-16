@extends('layouts.master')

@section('title', 'Propiedad')


<!-- @section('content_header')
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
@stop -->
@section('content')

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-12 text-right">
            <a href="/admin/propiedad/create" class="btn btn-success btn-sm  pull-right">
                <i class="fas fa-plus-circle"></i> &nbsp; Nuevo
            </a>
        </div>
        <div class="col-12 mt-3">
            @include('flash::message')
        </div>
        <div class="col-12 mt-3">
    
                <table id="mobiliaria" class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th><span class="small font-weight-bold">EASYBROKE </span> </th>
                            <th><span class="small font-weight-bold">CLAVE</ </th>
                            <th><span class="small font-weight-bold">TÍTULO </ </th>
                            <th><span class="small font-weight-bold">PRECIO </ </th>
                            <th><span class="small font-weight-bold">DIRECCIÓN </ </th>
                            <th><span class="small font-weight-bold">OPERACIÓN </ </th>
                            <th><span class="small font-weight-bold">HABITAR </ </th>
                            <th><span class="small font-weight-bold">PROPIETARIO </ </th>
                            <th><span class="small font-weight-bold">M<sup>2</sup> CONSTRUCCION  </ </th>
                            <th><span class="small font-weight-bold">M<sup>2</sup> TERRENO  </ </th>
                            <th><span class="small font-weight-bold"> FRENTE  </ </th>
                            <th><span class="small font-weight-bold"> FONDO </ </th>
                            <th><span class="small font-weight-bold">STATUS </ </th>
                            <th style="width: 180px"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($properties as $property)
                        <tr>
                            <td> <span class="small"> {{ $property->pass_easy_broker  }} </span> </td>
                            <td> <span class="small"> {{ $property->clave_interna }} </span> </td>
                            <td>  
                            @if ($property->is_titulo == 1)
                                <span class="badge bg-green">Sí</span>
                                @else
                                <span class="badge bg-red">No</span>
                            @endif    
                            </td>
                            <td> <span class="small"> {{ $property->price  }} </span> </td>
                            <td>
                               <span class="small"> {{ $property->address  }} </span>
                            </td>
                            <td>
                               <span class="small"> {{ $property->operations_description  }} </span>
                            </td>
                            <td>
                                @if ($property->habitar == 1)
                                <span class="badge bg-green">Sí</span>
                                @else
                                <span class="badge bg-red">No</span>
                                @endif
                            </td>
                            <td>
                                @if ($property->is_property == 1)
                                <span class="badge bg-green">Sí</span>
                                @else
                                <span class="badge bg-red">No</span>
                                @endif
                            </td>
                            
                            
                            <td><span class="small"> {{ $property->metros_construccion  }} </span></td>
                            <td><span class="small"> {{ $property->metros_terreno  }} </span></td>
                            <td><span class="small"> {{ $property->frente  }} </span></td>
                            <td><span class="small"> {{ $property->fondo  }} </span></td>
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
                                <!--  <a href="/admin/propiedad/{{ $property->id }}" class="btn btn-info">
                                    <i class="fas fa-file-pdf"></i>
                                </a> -->
                                @role('admin')
                                <button type="button" onclick="userModal({{ $property->id }})" class="btn btn-info btn-flat ml-1"><i class="fas fa-user-plus"></i></button>
                                @endrole
                                <a href="{{route('propiedad.edit', $property->id)}}" class="btn btn-primary ml-1">
                                    <i class="far fa-edit"></i>
                                </a>
                                @if($property->status == 0)
                                <a href="/admin/propiedad/status/{{ $property->id }}/1" class="btn btn-success ml-1">
                                    <i class="fas fa-ban text-white"></i>
                                </a>
                                @else
                                <a href="/admin/propiedad/status/{{ $property->id }}/0" class="btn btn-warning ml-1">
                                    <i class="fas fa-ban"></i>
                                </a>
                                @endif
                                @role('admin')
                                <button onclick="return confirm('¿Deseas eliminar el elemento?')" class="btn btn-danger ml-1">
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
{{-- modal agregar usuario captura --}}

<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Lista de usuarios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="property_id">
                <table id="table-users" class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Nick</th>
                            <th></th>
                        </tr>
                    </thead>
                
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td><span class="small">  {{ $user->name  }} </span> </td>
                            <td><span class="small">  {{ $user->username  }} </span> </td>
                            <td>
                                <button type="button" onclick="addUser('{{ $user->id }}')" class="btn btn-info  btn-sm ">
                                    <i class="fas fa-plus-circle"></i> Agregar
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


{{-- modal agregar usuario captura --}}
@endsection

@section('js')

<script>
    $(function() {

        /* $('#mobiliaria thead tr').clone(true).appendTo('#mobiliaria thead');

        $('#mobiliaria thead tr:eq(1) th').each(function(i) {

            var title = $(this).text();
            var ocultar = ($('#mobiliaria thead tr:eq(1) th').length == i + 1) ? 'hidden' : '';

            $(this).html('<input class="' + ocultar + '" type="text" placeholder="BUSCAR ' + title + '" />');

            $('input', this).on('keyup change', function() {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        }); */

        var table = $('#mobiliaria').DataTable({

            responsive: true,

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
        });

        $('#table-users').DataTable({
           
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
<script src="{{ asset('js/admin.js') }}"></script>
@stop