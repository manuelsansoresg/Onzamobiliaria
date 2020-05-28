@extends('layouts.master')

@section('title', 'ASIGNACIÓN DE ASESORES')


@section('content')
<div class="container-fluid">
    <input type="hidden" id="filtro" value="{{ isset($_GET['filtro'])? $_GET['filtro'] : '' }}">
    <input type="hidden" id="campo" value="{{ isset($_GET['campo'])? $_GET['campo'] : '' }}">
    <div class="row mt-3">
        <div class="col-12 mt-3">
            @include('flash::message')
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h5 class="mr-auto">ASIGNACIÓN DE ASESORES</h5>
                <div>
                    @role('admin')
                    <a href="/admin/seguimiento-asesores/create" class="btn btn-success btn-sm  pull-right"><i class="fas fa-plus-circle"></i> ASIGNACIÓN</a>
                    @endrole
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row d-none">
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
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="table_property_assigment" class="table  dataTables_scrollBody" style="width:100%">
                            <thead>
                            <tr>
                                @role('admin')
                                <th> <span class="small font-weight-bold"> SEGUIMIENTO </span> </th>
                                @endrole
                                <th> <span class="small font-weight-bold"> FECHA DE ASIG </span> </th>
                                <th> <span class="small font-weight-bold"> NOMBRE </span> </th>
                                <th> <span class="small font-weight-bold"> TELÉFONO </span> </th>
                                @role('admin')
                                <th> <span class="small font-weight-bold"> ASESOR </span> </th>
                                @endrole
                                <th> <span class="small font-weight-bold"> STATUS </span> </th>

                                <!-- <th>Llamadas</th> -->
                                <th style="width: 180px;" class=""></th>

                            </tr>

                            </thead>
                            <tbody ></tbody>
                            <tfoot>
                            <tr>


                                <th>FECHA DE ASIG</th>
                                <th>TELÉFONO</th>
                                @role('admin')
                                <th>ASESOR</th>
                                @endrole
                                <th>STATUS</th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="moreSection" tabindex="-1" role="dialog" aria-labelledby="moreSectionLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="moreSectionLabel">SEGUIMIENTO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-responsive dataTables_scrollBody">
                    <thead>
                       <tr>
                           <th> <small>EASYBROKER</small> </th>
                           <th> <small>PROPIEDAD</small> </th>
                           <th> <small>COLONIA</small> </th>
                           <th> <small>OPERACIÓN</small> </th>
                           <th><small>PRECIO</small></th>
                           <th><small>ASESOR</small></th>
                           <th><small>PORTAL</small></th>
                           <th><small>NOMBRE PROSPECTO</small></th>
                           <th><small>TELÉFONO</small></th>
                           <th><small>CORREO</small></th>
                           <th><small>ASESOR</small></th>
                           <th><small>LLAMADAS</small></th>

                       </tr>
                    </thead>
                    <tbody id="body_more">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <button type="button" class="btn btn-primary">GUARDAR</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')


<script>
      $(function() {

        var table = $('#property_assigment').DataTable({
            //"scrollX": true,
            responsive: true,
            searching: false,
            //"pagingType": "simple",
            //"bPaginate": true,
            //"bFilter": false ,
            //"bLengthMenu" : true, //thought this line could hide the LengthMenu
            "bInfo":false,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'pdf',
                    orientation: 'landscape',
                    text: 'PDF',
                    className: 'btn-danger',
                    title:'LISTADO DE PROSPECTO VENTA/RENTA(ASIGNACIÓN)',
                    fontSize: '6',
                    //messageTop: '', AGREGAR TITULO
                    pageSize: 'letter', //A3 , A4,A5 , A6 , legal , letter
                    pageMargins: [ 0, 0, 0, 0 ], // try #1 setting margins
                    margin: [ 0, 0, 0, 0 ], // try #2 setting margins
                    customize: function(doc) {
                        doc.styles.title = {
                            color: 'black',
                            fontSize: '10',
                            alignment: 'left'
                        }
                        doc.styles['td:nth-child(2)'] = {
                            width: '100px',
                            'max-width': '100px'
                        }
                        doc.styles.tableHeader = {
                            fillColor:'#525659',
                            color:'#FFF',
                            fontSize: '8',
                            alignment: 'left',
                            bold: true
                        }
                        doc.defaultStyle.fontSize = 9;
                        doc.pageMargins = [50,50,30,30];
                        doc.content[1].margin = [ 5, 0, 0, 5]
                    }
                },
                {
                    extend: 'excel',
                    text: 'EXCEL',
                },
                {
                    extend: 'print',
                    text: 'IMPRIMIR',
                }
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
    })
</script>
@stop
