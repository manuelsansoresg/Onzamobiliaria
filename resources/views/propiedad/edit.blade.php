@extends('layouts.master')

@section('title', 'PROPIEDAD')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-3">
        <div class="col-12 col-md-12 ">
            <div class="card">
                {{ Form::open(['route' => ['propiedad.update', $property->id], 'method' => 'PUT', 'files' => true, 'id' => 'frm_propiedad', 'class' => 'needs-validation', 'novalidate']) }}
                <h5 class="card-header">
                    <div class="d-flex align-items-center">
                        <h6 class="mr-auto">EDITAR PROPIEDAD</h6>
                        <a href="/admin/propiedad" class="btn btn-success btn-sm  pull-right">
                            <i class="fas fa-arrow-circle-left"></i> REGRESAR
                        </a>
                    </div>
                </h5>
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col-12">
                            <p>Los campos marcados con * son obligatorios</p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-md-4">
                            <div class="input-group mb-2">
                                <label class="small"><label class="small">AGREGAR NUEVO CONTACTO </label> </label>
                                @if ($property->is_new == 1)
                                <input type="checkbox" id="n_client" name="n_client" class="mt-1 ml-1" value="1" onchange="changeClient()" checked>
                                @else
                                <input type="checkbox" id="n_client" name="n_client" class="mt-1 ml-1" value="1" onchange="changeClient()">
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
                                        <label class="small">*CONTACTO</label>
                                        <div class="w-100"></div>
                                        <input type="hidden" name="cve_int_cliente" id="cve_int_cliente" value="{{ $property->client_id }}" class="form-control form-control-sm">
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
                            <div class="small text-danger" style="display: none" id="error_cliente">
                                Busque o agregue un nuevo contacto
                            </div>
                        </div>


                    </div>
                    <div class="row mt-3 mb-3">
                        <div class="col-12">
                            <span class="small font-weight-bold">DATOS DEL CONTACTO</span>
                        </div>

                    </div>
                    <?php $d_datos_clientes = ($property->is_new == 1) ? 'display:none' : '' ?>
                    <div class="row mt-3" style="{{ $d_datos_clientes }}" id="d_datos-cliente">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">NOMBRE</label>
                                <input class="form-control form-control-sm" id="client_name" value="{{ $client->nombre }}" readonly type="text">

                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">EMAIL</label>
                                <input class="form-control form-control-sm" id="client_email" value="{{ $client->correo }}" readonly type="email">

                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">TELÉFONO</label>
                                <input class="form-control form-control-sm" id="client_telefono" value="{{ $client->telefono }}" readonly type="text">

                            </div>
                        </div>
                    </div>
                    <?php $d_inputs_cliente = ($property->is_new == 1) ? '' : 'display:none' ?>
                    <div class="row" style=" {{ $d_inputs_cliente }}" id="d_inputs-cliente">
                        <div class="col-12 col-md-4 mt-3">
                            <div class="form-group">
                                <label class="small">NOMBRE</label>
                                <input name="cliente[nombre]" id="cliente_nombre" value="{{ $client->nombre }}" class="form-control form-control-sm input-edit" type="text" required>
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('cliente.nombre')}}</span>
                                @endif
                                <div class="invalid-feedback">
                                    El campo NOMBRE es obligatorio
                                </div>

                            </div>
                        </div>
                        <div class="col-12 col-md-4 mt-3">
                            <div class="form-group">
                                <label class="small">EMAIL</label>
                                <input name="cliente[correo]" id="cliente_correo" value="{{ $client->correo }}" class="form-control form-control-sm input-edit" type="text">
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('cliente.correo')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mt-3">
                            <div class="form-group">
                                <label class="small">TELÉFONO</label>
                                <input name="cliente[telefono]" id="cliente_telefono" value="{{ $client->telefono }}" class="form-control form-control-sm input-edit" type="text" required>
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('cliente.telefono')}}</span>
                                @endif
                                <div class="invalid-feedback">
                                    El campo TELÉFONO es obligatorio
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mt-3">
                            <div class="form-group">
                                <label class="small">PROPIETARIO</label>
                                @if ($client->is_property == 1)
                                <input name="cliente[is_property]" class="mt-2" value="1" type="checkbox" checked>
                                @else
                                <input name="cliente[is_property]" class="mt-2" value="1" type="checkbox">

                                @endif
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
                                <label class="small"><i class="fas fa-key pr-1 mt-2"></i>*CLAVE EASYBROKER</label>
                                <input name="pass_easy_broker" class="form-control form-control-sm" type="text" value="{{ $property->pass_easy_broker }}" required>
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('pass_easy_broker')}}</span>
                                @endif
                                <div class="invalid-feedback">
                                    El campo CLAVE EASYBROKER es obligatorio
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="form-group">
                                <label class="small">NOMBRE DESARROLLO</label>
                                <input name="name_property" class="form-control  form-control-sm" value="{{ $property->name_property }}" type="text" required>
                               
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="small">TIPO DE PROPIEDAD</label>
                                <select name="realstate_id" class="form-control form-control-sm">
                                    @foreach ($real_states as $real_state)
                                    <option value="{{ $real_state->id }}" {{ ($property->realstate_id == $real_state->id )? 'selected' : ''  }}> {{ $real_state->description }} </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="small">TIPO DE OPERACIÓN</label>
                                <select name="operation_id" class="form-control form-control-sm ">
                                    @foreach ($operations as $operation)
                                    <option value="{{ $operation->id }}" {{ ($property->operation_id == $operation->id)? 'selected' : '' }}> {{ $operation->description }} </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">AVALUO</label> &nbsp;
                                <input type="checkbox" name="avaluo" value="1" {{ ($property->is_avaluo == 1)? 'checked' : '' }}>
                                @if ($property->is_avaluo == 1)
                                <input type="text" name="Avaluo" value="{{ $property->Avaluo }}" id="Avaluo" class="form-control form-control-sm">
                                @else
                                <input type="text" name="Avaluo" id="Avaluo" disabled class="form-control form-control-sm">

                                @endif
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('Avaluo')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">DIRECCIÓN</label> &nbsp;
                                <input type="text" name="address" value="{{ $property->address }}" class="form-control form-control-sm">
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('address')}}</span>
                                @endif

                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="input-group mb-2">
                                <label class="small">* CÓDIGO POSTAL</label>
                                <div class="w-100"></div>
                                <input type="text" name="cp" id="cp" value="{{ $cp->codigo }}" class="form-control form-control-sm" required>
                                <div class="input-group-prepend">
                                    <button type="button" onclick="searchPostal()" class="btn btn-info btn-sm"><i class="fas fa-search"></i> BUSCAR</button>
                                </div>
                                @if($errors)
                                <div class="w-100"></div>
                                <p class="text-danger"> {{$errors->first('cp')}}</p>
                                @endif
                                <div class="invalid-feedback">
                                    El campo CÓDIGO POSTAL es obligatorio
                                </div>

                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">* COLONIA</label> &nbsp;
                                @if ($property->codigo == '')
                                <select name="colonia" id="colonia" class="form-control" disabled="">
                                </select>
                                @else
                                <select name="colonia" id="colonia" class="form-control form-control-sm">
                                    @foreach ($postals as $postal)
                                    <option value="{{ $postal->id }}" {{ ($postal->id == $property->postal_id )? 'selected' : '' }}>{{ $postal->colonia }}</option>
                                    @endforeach
                                </select>
                                @endif

                                @if($errors)
                                <span class="text-danger"> {{$errors->first('address')}}</span>
                                @endif

                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">INSTITUCIÓN</label>
                                <input name="institution" value="{{ $property->institution }}" class="form-control form-control-sm" type="text">
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">GRAVAMENES</label> &nbsp;
                                <input type="checkbox" {{ ($property->assessment == 1)? 'checked' : ''}} name="assessment" value="1">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">PRECIO DESEABLE</label>
                                <input name="price" data-behaviour="decimal" value="{{ $property->price }}" class="form-control form-control-sm" type="text" required>

                                @if($errors)
                                <span class="text-danger"> {{$errors->first('price')}}</span>
                                @endif
                                <div class="invalid-feedback">
                                    El campo PRECIO DESEABLE es obligatorio
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">SALDO</label>
                                <input name="saldo" data-behaviour="decimal" value="{{ $property->saldo }}" class="form-control form-control-sm" type="text">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">PREDIAL AL DÍA</label>
                                <input name="is_predial" {{ ($property->is_predial == 1)? 'checked' : ''}} type="checkbox" value="1">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">¿LA CASA SE ENCUENTRA HABITADA?</label> &nbsp;
                                <input type="checkbox" {{ ($property->habitar == 1)? 'checked' : ''}} name="habitar" value="1">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">¿CUENTAN CON DOCUMENTO PARA EXENTAR? </label>
                                <input type="checkbox" {{ ($property->document == 1)? 'checked' : ''}} name="document" value="1">
                                <select name="documentname[]" id="documentname" class="form-control  form-control-sm is-invalid" multiple="multiple" required>
                                    <option>IFE</option>
                                    <option>ACTA DE NACIMIENTO</option>
                                    <option>PREDIAL</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">PRIVADA</label>
                                <input type="checkbox" {{ ($property->privada == 1)? 'checked' : ''}} name="privada" value="1">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">CUOTA DE MANTENIMIENTO </label>
                                <input type="text" data-behaviour="decimal" value="{{ precio($property->cuota_mantenimiento) }}" name="cuota_mantenimiento" class="form-control form-control-sm">
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">TÍTULO</label>
                                <input type="checkbox" {{ ($property->is_titulo == 1)? 'checked' : ''}} name="is_titulo" value="1">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">COMISION</label>
                                <input type="text" data-behaviour="decimal" name="comision" class="form-control form-control-sm" value = "{{ $property->comision }}">                                
                            </div>                            
                        </div>

                        <div class="w-100"></div>
                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                <label class="small">COMENTARIOS</label>
                                <textarea name="observation1" class="form-control form-control-sm" id="" cols="30" rows="10">{{ $property->observation1 }}</textarea>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">*¿FORMAS DE PAGO DESEABLES?</label>
                                <div class="w-100"></div>
                                <select name="form_pay_id[]" id="form_pay_id" class="form-control form-control-sm" multiple="multiple" required>
                                    @foreach ($form_payments as $form_payment)
                                    <option value="{{ $form_payment->id }}" {{ ( in_array($form_payment->id, $my_payments) )? 'selected' : '' }}> {{ $form_payment->description }} </option>
                                    @endforeach
                                </select>
                                <div class="small text-danger" id="error_formapago" style="display: none">
                                    El campo ¿FORMAS DE PAGO DESEABLES? es obligatorio
                                </div>
                                @if($errors)
                                <div class="w-100"></div>
                                <span class="text-danger"> {{$errors->first('form_pay_id')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">M<sup>2</sup>DE CONSTRUCCIÓN</label>
                                <input name="metros_construccion" value="{{ $property->metros_construccion }}" class="form-control form-control-sm" type="text">
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
                                <input name="metros_terreno" class="form-control form-control-sm" type="text" value="{{ $property->metros_terreno }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">FRENTE</label>
                                <input name="frente" class="form-control form-control-sm" type="text" value="{{ $property->frente }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">FONDO</label>
                                <input name="fondo" class="form-control form-control-sm" type="text" value="{{ $property->fondo }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">ESTADO DE CONSERVACIÓN Y ANTIGÜEDAD</label>
                                <input name="estado_conservacion_antiguedad" class="form-control form-control-sm" type="text" value="{{ $property->estado_conservacion_antiguedad }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">INFRAESTRUCTURA DE LA ZONA</label>
                                <input name="infraestructura_zona" class="form-control form-control-sm" type="text" value="{{ $property->infraestructura_zona }}">
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
                                @if ($property->identificacion == null)
                                <input name="identificacion" class="form-control form-control-sm" type="file">
                                @else
                                <p class="">
                                    <i class="far fa-file fa-2x"></i>
                                </p>
                                <p>
                                    <a href="{{ asset($path_document.'/'.$property->id.'/'.$property->identificacion) }}" class="btn btn-success btn-sm">Abrir</a>
                                    <a href="/admin/destroy-document/identificacion/{{ $property->identificacion }}" class="btn btn-danger btn-sm">Borrar</a>
                                </p>
                                @endif
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">CURP</label>
                                @if ($property->curp == null)
                                <input name="curp" class="form-control form-control-sm" type="file">
                                @else
                                <p class="">
                                    <i class="far fa-file fa-2x"></i>
                                </p>
                                <p>
                                    <a href="{{ asset($path_document.'/'.$property->id.'/'.$property->curp) }}" class="btn btn-success btn-sm">Abrir</a>
                                    <a href="/admin/destroy-document/curp/{{ $property->curp }}" class="btn btn-danger btn-sm">Borrar</a>
                                </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">RFC</label>
                                @if ($property->rfc == null)
                                <input name="rfc" class="form-control form-control-sm" type="file">
                                @else
                                <p class="">
                                    <i class="far fa-file fa-2x"></i>
                                </p>
                                <p>
                                    <a href="{{ asset($path_document.'/'.$property->id.'/'.$property->rfc) }}" class="btn btn-success btn-sm">Abrir</a>
                                    <a href="/admin/destroy-document/rfc/{{ $property->rfc }}" class="btn btn-danger btn-sm">Borrar</a>
                                </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">ACTA DE NACIMIENTO</label>
                                @if ($property->acta_nacimiento == null)
                                <input name="acta_nacimiento" class="form-control form-control-sm" type="file">
                                @else
                                <p class="">
                                    <i class="far fa-file fa-2x"></i>
                                </p>
                                <p>
                                    <a href="{{ asset($path_document.'/'.$property->id.'/'.$property->acta_nacimiento) }} " target="_blank" class="btn btn-success btn-sm">Abrir</a>
                                    <a href="/admin/destroy-document/acta_nacimiento/{{ $property->acta_nacimiento }}" class="btn btn-danger btn-sm">Borrar</a>
                                </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">ACTA DE MATRIMONIO</label>
                                @if ($property->acta_matrimonio == null)
                                <input name="acta_matrimonio" class="form-control form-control-sm" type="file">
                                @else
                                <p class="">
                                    <i class="far fa-file fa-2x"></i>
                                </p>
                                <p>
                                    <a href="{{ asset($path_document.'/'.$property->id.'/'.$property->acta_matrimonio) }} " target="_blank" class="btn btn-success btn-sm">Abrir</a>
                                    <a href="/admin/destroy-document/acta_matrimonio/{{ $property->acta_matrimonio }}" class="btn btn-danger btn-sm">Borrar</a>
                                </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">PREDIAL</label>
                                @if ($property->predial == null)
                                <input name="predial" class="form-control form-control-sm" type="file">
                                @else
                                <p class="">
                                    <i class="far fa-file fa-2x"></i>
                                </p>
                                <p>
                                    <a href="{{ asset($path_document.'/'.$property->id.'/'.$property->predial) }}" target="_blank" class="btn btn-success btn-sm">Abrir</a>
                                    <a href="/admin/destroy-document/predial/{{ $property->predial }}" class="btn btn-danger btn-sm">Borrar</a>
                                </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">NO ADEUDO DE AGUA</label>
                                @if ($property->no_adeudo_agua == null)
                                <input name="no_adeudo_agua" class="form-control form-control-sm" type="file">
                                @else
                                <p class="">
                                    <i class="far fa-file fa-2x"></i>
                                </p>
                                <p>
                                    <a href="{{ asset($path_document.'/'.$property->id.'/'.$property->no_adeudo_agua) }}" target="_blank" class="btn btn-success btn-sm">Abrir</a>
                                    <a href="/admin/destroy-document/no_adeudo_agua/{{ $property->no_adeudo_agua }}" class="btn btn-danger btn-sm">Borrar</a>
                                </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">NO ADEUDO DE PREDIAL</label>
                                @if ($property->no_adeudo_predial == null)
                                <input name="no_adeudo_predial" class="form-control form-control-sm" type="file">
                                @else
                                <p class="">
                                    <i class="far fa-file fa-2x"></i>
                                </p>
                                <p>
                                    <a href="{{ asset($path_document.'/'.$property->id.'/'.$property->no_adeudo_predial) }}" target="_blank" class="btn btn-success btn-sm">Abrir</a>
                                    <a href="/admin/destroy-document/no_adeudo_predial/{{ $property->no_adeudo_predial }}" class="btn btn-danger btn-sm">Borrar</a>
                                </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">CÉDULA</label>
                                @if ($property->cedula_plano_catastral == null)
                                <input name="cedula_plano_catastral" class="form-control form-control-sm" type="file">
                                @else
                                <p class="">
                                    <i class="far fa-file fa-2x"></i>
                                </p>
                                <p>
                                    <a href="{{ asset($path_document.'/'.$property->id.'/'.$property->cedula_plano_catastral) }}" target="_blank" class="btn btn-success btn-sm">Abrir</a>
                                    <a href="/admin/destroy-document/cedula_plano_catastral/{{ $property->cedula_plano_catastral }}" class="btn btn-danger btn-sm">Borrar</a>
                                </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">PLANO CATASTRAL ACTUALIZADO</label>
                                @if ($property->plano_catastral == null)
                                <input name="plano_catastral" class="form-control form-control-sm" type="file">
                                @else
                                <p class="">
                                    <i class="far fa-file fa-2x"></i>
                                </p>
                                <p>
                                    <a href="{{ asset($path_document.'/'.$property->id.'/'.$property->plano_catastral) }}" target="_blank" class="btn btn-success btn-sm">Abrir</a>
                                    <a href="/admin/destroy-document/plano_catastral/{{ $property->plano_catastral }}" class="btn btn-danger btn-sm">Borrar</a>
                                </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">COPIA DE LA ESCRITURA</label>
                                @if ($property->copia_escritura == null)
                                <input name="copia_escritura" class="form-control form-control-sm" type="file">
                                @else
                                <p class="">
                                    <i class="far fa-file fa-2x"></i>
                                </p>
                                <p>
                                    <a href="{{ asset($path_document.'/'.$property->id.'/'.$property->copia_escritura) }}" target="_blank" class="btn btn-success btn-sm">Abrir</a>
                                    <a href="/admin/destroy-document/copia_escritura/{{ $property->copia_escritura }}" class="btn btn-danger btn-sm">Borrar</a>
                                </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="form-group">
                                <label class="small">REGLAMENTO DE CONDOMINOS Y NO ADEUDO DE CUOTAS EN SU CASO</label>
                                @if ($property->reglamento_condominios_no_adeudo == null)
                                <input name="reglamento_condominios_no_adeudo" class="form-control form-control-sm" type="file">
                                @else
                                <p class="">
                                    <i class="far fa-file fa-2x"></i>
                                </p>
                                <p>
                                    <a href="{{ asset($path_document.'/'.$property->id.'/'.$property->reglamento_condominios_no_adeudo) }}" target="_blank" class="btn btn-success btn-sm">Abrir</a>
                                    <a href="/admin/destroy-document/reglamento_condominios_no_adeudo/{{ $property->reglamento_condominios_no_adeudo }}" class="btn btn-danger btn-sm">Borrar</a>
                                </p>
                                @endif
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
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clientModalLabel">AGREGAR CONTAC</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <table id="client" class="table table-bordered dataTables_scrollBody">
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

            responsive: true,
            "pageLength": 5,
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