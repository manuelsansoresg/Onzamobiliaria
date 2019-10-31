@extends('adminlte::page')

@section('title', 'Propiedad')

@section('css')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stop

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
                    <a href="/admin/propiedad/create" class="btn btn-success  pull-right">
                        <i class="fas fa-plus-circle"></i> &nbsp; Nuevo
                    </a>
                </div>
                <br><br>
                <div class="col-md-12">
                    @include('flash::message')
                </div>
                <br><br><br>
                <table id="mobiliaria" class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>Inmobiliaria</th>
                            <th>Usuario asignado</th>
                            <th>Operación</th>
                            <th>Pago</th>
                            <th>Avaluo</th>
                            <th>Gravamenes</th>
                            <th>Habitar</th>
                            <th>Propietario</th>
                            <th>Status</th>
                            <th style="width: 180px"></th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($properties as $property)
                        <tr>
                            <td>{{ $property->realstate_description  }}</td>
                            <td> {{ $property->username }} </td>
                            <td>{{ $property->operations_description  }}</td>
                            <td>{{ $property->form_payment_description  }}</td>
                            <td>
                                @if ($property->Avaluo == 1)
                                <span class="badge bg-green">Sí</span>
                                @else
                                <span class="badge bg-red">No</span>
                                @endif
                            </td>
                            <td>
                                @if ($property->assessment == 1)
                                <span class="badge bg-green">Sí</span>
                                @else
                                <span class="badge bg-red">No</span>
                                @endif
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
                                   <button type="button" onclick="userModal({{ $property->id }})" class="btn btn-info btn-flat "><i class="fas fa-user-plus"></i></button>
                                @endrole
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
                                @role('admin')
                                <button onclick="return confirm('¿Deseas eliminar el elemento?')" class="btn btn-danger">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                                @endrole
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                <div class="col-md-12 text-center">

                </div>
            </div>

        </div>

    </div>
</div>
{{-- modal agregar usuario captura --}}
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="myModalUser">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalUser">Lista de usuarios</h4>
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
                            <td>{{ $user->name  }}</td>
                            <td>{{ $user->username  }}</td>
                            <td>
                                <button type="button" onclick="addUser('{{ $user->id }}')" class="btn btn-info btn-flat ">
                                   <i class="fas fa-plus-circle"></i> Agregar
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>
{{-- modal agregar usuario captura --}}
@stop

@section('js')
<script src="{{ asset('vendor/adminlte/plugins/datatable/js/responsive.js') }}"></script>
<script>
    $(function() {

       $('#mobiliaria thead tr').clone(true).appendTo( '#mobiliaria thead' );
       
        $('#mobiliaria thead tr:eq(1) th').each( function (i) {
            
            var title   = $(this).text();
            var ocultar = ($('#mobiliaria thead tr:eq(1) th').length == i+1)? 'hidden': '';
            
            $(this).html( '<input class="'+ocultar+'" type="text" placeholder="Buscar '+title+'" />' );
            
            $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                .column(i)
                .search( this.value )
                .draw();
            }
            } );
        } );
        
        var table = $('#mobiliaria').DataTable( {
        orderCellsTop: true,
        fixedHeader: true,
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
        } );

        $('#table-users').DataTable({
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
<script src="{{ asset('js/admin.js') }}"></script>
@stop