@extends('layouts.master')

@section('title', 'PROPIEDAD')

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor_assets/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">        
        <div class="col-12 mt-3">
            @include('flash::message')
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="col-12 mt-3 px-4 justify-content-end">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h6 class="mr-auto">FILTROS DE BÚSQUEDA</h6>
                    <a href="/admin/propiedad/create" class="btn btn-success btn-sm  pull-right">
                        <i class="fas fa-plus-circle"></i> AGREGAR PROPIEDAD
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mt-3">
                        <form action="" method="GET" class="form-inline ">
                            <div class="row">
                                <div class="form-group">                                
                                    <label class="px-2" for="inlineFormInputName2">FECHA INICIAL: </label>
                                    <input type="text" name="fecha_inicial" autocomplete="off" value="{{ (isset($_GET['fecha_inicial'])) ? $_GET['fecha_inicial'] : date('Y-m').'-01' }}" class="form-control px-2 form-control-sm datepicker">
                                    <label class="px-2" for="inlineFormInputName2">FECHA FINAL: </label>
                                    <input type="text" name="fecha_final" autocomplete="off" value="{{ (isset($_GET['fecha_final'])) ? $_GET['fecha_final'] : date('Y-m-d') }}" class="form-control px-2 form-control-sm datepicker">
                                    <label class="px-2" for="inlineFormInputName2">ESTATUS : </label>
                                    <select name="status"  class="form-control form-control-sm">
                                        <option value="" {{ (isset($_GET['status']) && $_GET['status'] == '' ) ? 'selected': '' }}>TODOS</option>
                                        <option value="1" {{ (isset($_GET['status']) && $_GET['status'] == 1 ) ? 'selected': '' }}>Disponible</option>
                                        <option value="0" {{ (isset($_GET['status']) && $_GET['status'] == 0 ) ? 'selected': '' }}>No Disponible</option>
                                    </select>
                                </div>                                                         
                                <div class="row-md-12 text-right">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> BUSCAR</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="col-12 mt-3 px-4 justify-content-end">     
        <div class="card">            
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mt-3">
                        <table id="mobiliaria" class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th><span class="small font-weight-bold">EASYBROKER </span> </th>
                                    <th><span class="small font-weight-bold">ASESOR</ </th> <th><span class="small font-weight-bold">TÍTULO </ </th> 
                                    <th><span class="small font-weight-bold">PRECIO </ </th> 
                                    <th><span class="small font-weight-bold">DIRECCIÓN </ </th> <th>
                                    <span class="small font-weight-bold">OPERACIÓN </ </th>                         
                                    <th><span class="small font-weight-bold">PROPIETARIO </ </th> <th><span class="small font-weight-bold">M<sup>2</sup> CONSTRUCCION </ </th> <th><span class="small font-weight-bold">M<sup>2</sup> TERRENO </ </th> <th><span class="small font-weight-bold"> FRENTE </ </th> <th><span class="small font-weight-bold"> FONDO </ </th> <th><span class="small font-weight-bold">STATUS </ </th> <th style="width: 180px">
                                    </th>
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
                                    <td><span class="small"> {{ precio($property->price)  }} </span> </td>
                                    <td><span class="small"> {{ $property->address  }} </span></td>
                                    <td><span class="small"> {{ $property->operations_description  }} </span></td>                        
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
                                        {{--<button type="button" onclick="userModal({{ $property->id }})" class="btn btn-info btn-flat ml-1"><i class="fas fa-user-plus"></i></button>--}}
                                        @endrole
                                        <a href="{{route('propiedad.edit', $property->id)}}" class="btn btn-primary ml-1">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        @if($property->status == 0)
                                        @role('admin')
                                            <a href="/admin/propiedad/status/{{ $property->id }}/1" class="btn btn-success ml-1">
                                                <i class="fas fa-ban text-white"></i>
                                            </a>
                                        @endrole
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
        </div>          
    </div>
</div>
{{-- modal agregar usuario captura --}}

<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
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
                            <td><span class="small"> {{ $user->name  }} </span> </td>
                            <td><span class="small"> {{ $user->username  }} </span> </td>
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
<script src="{{ asset('vendor_assets/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
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
            searching: false,
            dom: 'Bfrtip',
            buttons: [
            'excel', 'pdf', 'print'
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
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        })

    })
</script>
{{-- <script src="{{ asset('js/admin.js') }}"></script> --}}
@stop