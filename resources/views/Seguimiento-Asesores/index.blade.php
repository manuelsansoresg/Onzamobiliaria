@extends('layouts.master')

@section('title', 'Asignación de Asesores')


@section('content')
<div class="container-fluid">
    <div class="row mt-3">
        @role('admin')
        <div class="col-12 text-right">
            <a href="/admin/seguimiento-asesores/create" class="btn btn-success btn-sm  pull-right">
                <i class="fas fa-plus-circle"></i> &nbsp; Asignación
            </a>
        </div>
        @endrole
        <div class="col-12 mt-3">
            @include('flash::message')
        </div>
    </div>
</div>
    <div class="container-fluid">
        
        <div class="row mt-3 px-3 justify-content-end">
            <form action="" method="GET" class="form-inline ">
                
                <label class="" for="inlineFormInputName2">Filtro: </label>
                <select name="filtro" class="for-control form-control-sm mx-2">
                    <option value="TODOS">TODOS</option>
                    @foreach ($all_status as $status)
                        <option value="{{ $status->id }}" {{ (isset($_GET['filtro']) && $_GET['filtro'] == $status->id ) ? 'selected'  : '' }}> {{ $status->description }} </option>
                    @endforeach
                </select>
    
                <label class="mx-2" for="inlineFormInputGroupUsername2">Buscar</label>
               
                <input type="text" name="campo" value="{{ (isset($_GET['campo'])) ? $_GET['campo'] : '' }}" class="form-control form-control-sm">
              
    
                <button type="submit" class="btn btn-primary btn-sm mx-2"><i class="fas fa-search"></i> Buscar</button>
            </form>
        </div>
    </div>    
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-3">
    
                <table id="property_assigment" class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th> <span class="small font-weight-bold"> CVE EASYBROKER </span> </th>
                            <th> <span class="small font-weight-bold"> PROPIEDAD</span> </th>
                            <th> <span class="small font-weight-bold"> COLONIA </span> </th>
                            <th> <span class="small font-weight-bold"> OPERACIÓN </span> </th>
                            <th> <span class="small font-weight-bold"> PRECIO </span> </th>
                            <th> <span class="small font-weight-bold"> ASESOR </span> </th>
                            <th> <span class="small font-weight-bold"> PORTAL </span> </th>
                            <th> <span class="small font-weight-bold"> NOMBRE PROSPECTO </span> </th>
                            <th> <span class="small font-weight-bold"> TELEFONO </span> </th>
                            <th> <span class="small font-weight-bold"> CORREO </span> </th>
                            @role('admin')
                                <th> <span class="small font-weight-bold"> ASIGNAR ASESOR </span> </th>
                           <!--  <th>LLAMADAS</th> -->
                            @endrole
                                <th style="width: 160px;"></th>
    
                        </tr>
                    </thead>
                    @foreach ($property_assignments as $property_assignment)
                    <tbody id="table-assigment">
                        <tr>
                            <td>
                                <span class="small"> {{ $property_assignment->pass_easy_broker }} </span>
                            </td>
                            <td> <span class="small"> {{ $property_assignment->propiedad }} </span> </td>
                            <td> <span class="small"> {{ $property_assignment->colonia }} </span> </td>
                            <td> <span class="small"> {{ $property_assignment->operacion }} </span> </td>
                            <td> <span class="small"> {{ $property_assignment->price }} </span> </td>
                            <td> <span class="small"> {{ $property_assignment->asesor }} </span> </td>
                            <td> <span class="small"> {{ $property_assignment->portal }} </span> </td>
                            <td> <span class="small"> {{ $property_assignment->nombre_prospecto }} </span> </td>
                            <td> <span class="small"> {{ $property_assignment->telefono }} </span> </td>
                            <td> <span class="small"> {{ $property_assignment->correo }} </span> </td>
                            @role('admin')
                                <td> <span class="small"> {{ $property_assignment->asesor_asignado }} </span> </td>
                            @endrole
    
                            <td>
                                {{ Form::open(['route' => ['seguimiento-asesores.destroy', $property_assignment->assignment_id ],'class' => 'form-inline', 'method' => 'DELETE' ])}}
                                <a href="/admin/historico-seguimiento/{{ $property_assignment->assignment_id }}" class="btn btn-primary">
                                    <i class="fas fa-phone-volume"></i>
                                </a>
    
                                @role('admin')
                                <a href="{{route('seguimiento-asesores.edit', $property_assignment->assignment_id)}}" class="btn btn-primary ml-1">
                                    <i class="far fa-edit"></i>
                                </a>
                                <button onclick="return confirm('¿Deseas eliminar el elemento?')" class="btn btn-danger ml-1">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                                @endrole
                                {{ Form::close() }}
                            </td>
                        </tr>
                    </tbody>
                    {{-- <tbody>
                            @role('admin')
                            <tr class="{{ classAlert($property_assignment->id) }}">
                    @else
                    <tr>
                        @endrole
                        <td>{{ $property_assignment->id  }}</td>
                        <td>
                            Calle: {{ $property_assignment->street  }} No int: {{ $property_assignment->noInt  }} No ext: {{ $property_assignment->noExt  }}
                            Colonia: {{ $property_assignment->colonia }}
                        </td>
                        @role('admin')
                        <td>
                            {{ $property_assignment->pass_easy_broker }}
                        </td>
                        @endrole
                        <td>
                            {{ countCalls($property_assignment->id) }}
    
                        </td>
    
                        <td>
                            {{ Form::open(['route' => ['seguimiento-asesores.destroy', $property_assignment->id ],'class' => 'form-inline', 'method' => 'DELETE' ])}}
                            <a href="/admin/seguimiento-asesores/lista/{{ $property_assignment->id }}" class="btn btn-primary">
                                <i class="fas fa-phone-volume"></i>
                            </a>
    
    
                            {{ Form::close() }}
                        </td>
    
                    </tr>
                    </tbody> --}}
                    @endforeach
    
                </table>

            </div>
        </div>
        <div class="row">
            <div class="col-12">
                {{ $property_assignments->links() }}
            </div>
        </div>
    </div>

@stop

@section('js')
<script src="{{ asset('vendor/adminlte/plugins/datatable/js/responsive.js') }}"></script>
<script src="{{ asset('js/admin.js') }}"></script>
<script>
   /*  $(function() {

        var table = $('#property_assigment').DataTable({
            "scrollX": true,

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
        });
    }) */
</script>
@stop
