@extends('layouts.master')

@section('title', 'PROPIEDAD')



@section('content')
<div class="container">
    <div class="row justify-content-center mt-3">
        <div class="col-12 col-md-12 ">
            <div class="card">
                {{ Form::open(['route' => 'propiedad.store', 'method' => 'POST',  'files' => true, 'id' => 'frm_propiedad']) }}
                <h5 class="card-header">
                    <div class="d-flex align-items-center">
                        <h6 class="mr-auto">AGREGAR PROPIEDAD</h6>
                        <a href="/admin/propiedad" class="btn btn-success btn-sm  pull-right">
                            <i class="fas fa-arrow-circle-left"></i> REGRESAR
                        </a>
                    </div>
                </h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <p>Los campos marcados con * son obligatorios</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="input-group mb-2">
                                <label class="small">AGREGAR NUEVO CLIENTE </label>
                                <?php $display_client = (old('n_client') == 1) ? '' : 'display:none' ?>
                                <?php $display_client_read = (old('n_client') == 0) ? '' : 'display:none' ?>
                                @if (old('n_client') == 1)
                                <input type="checkbox" id="n_client" name="n_client" class="mt-1 ml-1" value="1" class="custom-control-input" onchange="changeClient()" checked>
                                @else
                                <input type="checkbox" id="n_client" name="n_client" class="mt-1 ml-1" value="1" class="custom-control-input" onchange="changeClient()">
                                @endif

                                <div class="w-100"></div>
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('cliente.nombre')}}</span>
                                @endif
                            </div>


                        </div>
                        <div class="w-100"></div>
                        <div class="col-12 col-md-4">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="input-group mb-2">
                                        <label class="small">CLIENTE</label>
                                        <div class="w-100"></div>
                                        <input type="hidden" name="cve_int_cliente" id="cve_int_cliente" class="form-control form-control-sm">
                                        @if($errors)
                                        <span class="text-danger"> {{$errors->first('cve_int_cliente')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="input-group-prepend">
                                        <button type="button" data-toggle="modal" data-target="#clientModal" class="btn btn-info btn-sm"><i class="fas fa-search"></i> BUSCAR</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="row mt-3 mb-3">
                        <div class="col-12">
                            <span class="small font-weight-bold">DATOS DEL CLIENTE</span>
                        </div>

                    </div>
                    <div class="row mt-3 " style="{{ $display_client_read }}" id="d_datos-cliente">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">NOMBRE</label>
                                <input class="form-control form-control-sm" id="client_name" readonly type="text">

                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">EMAIL</label>
                                <input class="form-control form-control-sm" id="client_email" readonly type="email">

                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">TELÉFONO</label>
                                <input class="form-control form-control-sm" id="client_telefono" readonly type="text">
                            </div>
                        </div>
                    </div>
                    <div class="row " id="d_inputs-cliente" style="{{ $display_client }}">
                        <div class="col-12 col-md-4 mt-3">
                            <div class="form-group">
                                <label class="small">NOMBRE</label>
                                <input name="cliente[nombre]" value="{{ old('cliente.nombre') }}" class="form-control form-control-sm" type="text">
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('cliente.nombre')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mt-3">
                            <div class="form-group">
                                <label class="small">EMAIL</label>
                                <input name="cliente[correo]" value="{{ old('cliente.correo') }}" class="form-control form-control-sm" type="text">
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('cliente.correo')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mt-3">
                            <div class="form-group">
                                <label class="small">TELÉFONO</label>
                                <input name="cliente[telefono]" value="{{ old('cliente.telefono') }}" class="form-control form-control-sm" type="text">
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('cliente.telefono')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mt-3">
                            <div class="form-group">
                                <label class="small">PROPIETARIO</label>
                                <input name="cliente[is_property]" class="mt-2" value="1" type="checkbox">
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('cliente.is_property')}}</span>
                                @endif
                            </div>
                        </div>
                    </div>



                    <div class="row mt-3">
                        <div class="col-12">
                            <span class="small font-weight-bold">DATOS DE LA PROPIEDAD</span>
                        </div>
                    </div>



                    <div class="row mt-3">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small"><i class="fas fa-key pr-1 mt-2"></i>CLAVE EASYBROKER</label>
                                <input name="pass_easy_broker" class="form-control is-valid form-control-sm" value="{{ old('pass_easy_broker') }}" type="text" required>
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('pass_easy_broker')}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="small">TIPO DE PROPIEDAD</label>
                                <select name="realstate_id" class="form-control form-control-sm">
                                    @foreach ($real_states as $real_state)
                                    <option value="{{ $real_state->id }}"> {{ $real_state->description }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="small">TIPO DE OPERACIÓN</label>
                                <select name="operation_id" class="form-control form-control-sm ">
                                    @foreach ($operations as $operation)
                                    <option value="{{ $operation->id }}"> {{ $operation->description }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">AVALUO</label> &nbsp;
                                <input type="checkbox" name="avaluo" id="is_avaluo" onchange="changeAvaluo()" value="activo">
                                <input type="text" name="Avaluo" id="Avaluo" disabled class="form-control form-control-sm">
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('Avaluo')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">DIRECCIÓN</label> &nbsp;
                                <input type="text" name="address" value="{{ old('address') }}" class="form-control form-control-sm">
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('address')}}</span>
                                @endif

                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="input-group mb-2">
                                <label class="small">* CÓDIGO POSTAL</label>
                                <div class="w-100"></div>
                                <input type="text" name="cp" id="cp" value="{{ old('cp') }}" class="form-control is-valid form-control-sm" required>
                                <div class="input-group-prepend">
                                    <button type="button" onclick="searchPostal()" class="btn btn-info btn-sm"><i class="fas fa-search"></i> BUSCAR</button>
                                </div>
                                @if($errors)
                                <div class="w-100"></div>
                                <p class="text-danger"> {{$errors->first('cp')}}</p>
                                @endif

                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">* COLONIA</label> &nbsp;
                                <select name="colonia" id="colonia" class="form-control form-control-sm" disabled="">
                                </select>
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('address')}}</span>
                                @endif

                            </div>
                        </div>



                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">INSTITUCIÓN</label>
                                <input name="institution" value="{{ old('institution') }}" class="form-control form-control-sm" type="text">
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">GRAVAMENES</label> &nbsp;
                                <input type="checkbox" name="assessment" value="1">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">* PRECIO DESEABLE</label>
                                <input name="price" value="{{ old('price') }}" data-behaviour="decimal" class="form-control is-valid form-control-sm" type="text" required>
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('price')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">SALDO</label>
                                <input name="saldo" value="{{ old('saldo') }}" data-behaviour="decimal" class="form-control form-control-sm" type="text">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">PREDIAL AL DÍA</label>
                                <input name="is_predial" type="checkbox" value="1">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">¿LA CASA SE ENCUENTRA HABITADA?</label> &nbsp;
                                <input type="checkbox" name="habitar" value="1">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">¿CUENTAN CON DOCUMENTO PARA EXENTAR?</label>
                                <input type="checkbox" name="document" value="1">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">PRIVADA</label>
                                <input type="checkbox" name="privada" value="1">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">CUOTA DE MATENIMIENTO</label>
                                <input type="text" data-behaviour="decimal" name="cuota_mantenimiento" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                <label class="small">COMENTARIOS </label>
                                <textarea class="form-control form-control-sm" name="observation1" id="" cols="30" rows="10">{{ old('observation1') }}</textarea>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">* ¿FORMAS DE PAGO DESEABLES?</label>
                                <div class="w-100"></div>
                                <select name="form_pay_id[]" id="form_pay_id" class="form-control is-valid form-control-sm" multiple="multiple" required>
                                    @foreach ($form_payments as $form_payment)
                                    <option value="{{ $form_payment->id }}"> {{ $form_payment->description }} </option>
                                    @endforeach
                                </select>
                                @if($errors)
                                <div class="w-100"></div>
                                <span class="text-danger"> {{$errors->first('form_pay_id')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">M<sup>2</sup>DE CONSTRUCCIÓN</label>
                                <input name="metros_construccion" value="{{ old('metros_construccion') }}" class="form-control form-control-sm" type="text">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12">
                            <span class="small font-weight-bold">DESCRIPCIÓN</span>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">M<sup>2</sup>DE TERRENO</label>
                                <input name="metros_terreno" value="{{ old('metros_terreno') }}" class="form-control form-control-sm" type="text">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">FRENTE</label>
                                <input name="frente" value="{{ old('frente') }}" class="form-control form-control-sm" type="text">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">FONDO</label>
                                <input name="fondo" value="{{ old('fondo') }}" class="form-control form-control-sm" type="text">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">ESTADO DE CONSERVACIÓN Y ANTIGÜEDAD</label>
                                <input name="estado_conservacion_antiguedad" value="{{ old('estado_conservacion_antiguedad') }}" class="form-control form-control-sm" type="text">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">INFRAESTRUCTURA DE LA ZONA</label>
                                <input name="infraestructura_zona" value="{{ old('infraestructura_zona') }}" class="form-control form-control-sm" type="text">
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-12">
                            <span class="small font-weight-bold">DOCUMENTACIÓN</span>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">IDENTIFICACIÓN OFICIAL VIGENTE</label>
                                <input name="identificacion" class="form-control form-control-sm" type="file">
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">CURP</label>
                                <input name="curp" class="form-control form-control-sm" type="file">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">RFC</label>
                                <input name="rfc" class="form-control form-control-sm" type="file">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">ACTA DE NACIMIENTO</label>
                                <input name="acta_nacimiento" class="form-control form-control-sm" type="file">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">ACTA DE MATRIMONIO</label>
                                <input name="acta_matrimonio" class="form-control form-control-sm" type="file">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">PREDIAL</label>
                                <input name="predial" class="form-control form-control-sm" type="file">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">NO ADEUDO DE AGUA</label>
                                <input name="no_adeudo_agua" class="form-control form-control-sm" type="file">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">NO ADEUDO DE PREDIAL</label>
                                <input name="no_adeudo_predial" class="form-control form-control-sm" type="file">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">CÉDULA</label>
                                <input name="cedula_plano_catastral" class="form-control form-control-sm" type="file">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">PLANO CATASTRAL ACTUALIZADO</label>
                                <input name="plano_catastral" class="form-control form-control-sm" type="file">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">COPIA DE LA ESCRITURA</label>
                                <input name="copia_escritura" class="form-control form-control-sm" type="file">
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="form-group">
                                <label class="small">REGLAMENTO DE CONDOMINOS Y NO ADEUDO DE CUOTAS EN SU CASO</label>
                                <input name="reglamento_condominios_no_adeudo" class="form-control form-control-sm" type="file">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right pb-4">
                            <button class="btn btn-primary btn-lg">Guardar</button>
                        </div>
                    </div>

                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

</div>


<!-- Modal -->
<div class="modal fade" id="clientModal" tabindex="-1" role="dialog" aria-labelledby="clientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clientModalLabel">AGREGAR CLIENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <table id="client" class="table table-striped table-bordered dataTables_scrollBody" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><span class="small font-weight-bold"> NOMBRE </span> </th>
                                        <th><span class="small font-weight-bold"> CORREO </span> </th>
                                        <th><span class="small font-weight-bold"> TELÉFONO </span> </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)

                                    <tr>
                                        <td> <span class="small">{{ $client->nombre }}</span> </td>
                                        <td> <span class="small">{{ $client->correo }}</span> </td>
                                        <td> <span class="small">{{ $client->telefono }}</span> </td>
                                        <td>
                                            <button type="button" onclick="addClient('{{ $client->id }}','{{ $client->nombre }}', '{{ $client->correo }}', '{{ $client->telefono }}')" class="btn btn-info  btn-sm ">
                                                <i class="fas fa-plus-circle"></i>
                                            </button>
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
        var table = $('#client').DataTable({
            "scrollX": true,
            "bSearchable": true,
            "bFilter": true,
            responsive: true,
            "bLengthChange": false,
            "processing": true,
            "info": true,
            "stateSave": true,
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
        $('.dataTables_filter input').addClass('form-control-sm');
    })
</script>

@endsection