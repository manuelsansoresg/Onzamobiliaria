@extends('layouts.master')

@section('title', 'Propiedad')

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-12 text-right">
            <a href="/admin/propiedad" class="btn btn-success btn-sm  pull-right">
                <i class="fas fa-arrow-circle-left"></i> &nbsp; Regresar
            </a>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-12 col-md-12 ">
            {{ Form::open(['route' => 'clientes.store', 'method' => 'POST']) }}
            <div class="row">
                <div class="col-12">
                    <h5>Nueva Propiedad</h5>
                </div>
                <div class="col-12">
                    <p class="text-yellow">Los campos marcados con * son obligatorios</p>
                
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 col-md-4">
                    <div class="input-group mb-2">
                        <input type="text" class="form-control form-control-sm" id="inlineFormInputGroup" placeholder="CVE INT Cliente">
                        <div class="input-group-prepend">
                            <button class="btn btn-info btn-sm">Buscar</button>
                        </div>
                    
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
                        <label for="exampleInputEmail1">Tipo de Propiedad</label>
                        <select name="inmobiliaria" class="form-control form-control-sm">
                            @foreach ($real_states as $real_state)
                            <option value="{{ $real_state->id }}"> {{ $real_state->description }} </option>
                            @endforeach
                        </select>
                       
                    </div>
                </div>
               
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tipo de Operación</label>
                        <select name="operacion" class="form-control">
                            @foreach ($operations as $operation)
                            <option value="{{ $operation->id }}"> {{ $operation->description }} </option>
                            @endforeach
                        </select>
                       
                    </div>
                </div>
                
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Avaluo</label> &nbsp;
                        <input type="checkbox" name="avaluo" value="1">
                       
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Dirección</label> &nbsp;
                        <input type="text" name="address" class="form-control form-control-sm">
                        @if($errors)
                        <span class="text-danger"> {{$errors->first('address')}}</span>
                        @endif
                       
                    </div>
                </div>
                
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Institución</label>
                        <input name="institucion" class="form-control form-control-sm" type="text">
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Gravamenes</label> &nbsp;
                        <input type="checkbox" name="gravamenes" value="1">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                       <label>Precio</label>
                        <input name="precio" class="form-control form-control-sm" type="text">
                    </div>
                </div>
               
                <div class="col-12 col-md-4">
                    <div class="form-group">
                       <label>Saldo</label>
                        <input name="saldo" class="form-control form-control-sm" type="text">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>Predial al día</label>
                        <input name="is_predial"  type="checkbox">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>¿La casa se encuentra habitada?</label> &nbsp;
                        <input type="checkbox" name="habitar" value="1">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                       <label> ¿Cuentan con documento para exentar? </label>
                       <input type="checkbox" name="habitar" value="1">
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                       <label>¿Formas de pago deseables?</label>
                        <select name="pago" class="form-control">
                            @foreach ($form_payments as $form_payment)
                            <option value="{{ $form_payment->id }}"> {{ $form_payment->description }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                       <label>M<sup>2</sup> de construcción</label>
                       <input name="metros_construccion" class="form-control form-control-sm" type="text">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                       <label>M<sup>2</sup> de Terreno</label>
                       <input name="metros_terreno" class="form-control form-control-sm" type="text">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                       <label>Frente</label>
                       <input name="frente" class="form-control form-control-sm" type="text">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                       <label>Fondo</label>
                       <input name="fondo" class="form-control form-control-sm" type="text">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                       <label>Estado de conservación y antigüedad</label>
                       <input name="estado_conservacion_antiguedad" class="form-control form-control-sm" type="text">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                       <label>Infraestructura de la zona</label>
                       <input name="infraestructura_zona" class="form-control form-control-sm" type="text">
                    </div>
                </div>
                
                

            </div>
            <div class="row">
                <div class="col-12">
                    <span class="small font-weight-bold">DOCUMENTACIÓN</span>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>IDENTIFICACIÓN OFICIAL VIGENTE</label>
                        <input name="identificacion" class="form-control form-control-sm" type="file">
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>CURP</label>
                        <input name="curp" class="form-control form-control-sm" type="file">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>RFC</label>
                        <input name="rfc" class="form-control form-control-sm" type="file">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>ACTA DE NACIMIENTO</label>
                        <input name="acta_nacimiento" class="form-control form-control-sm" type="file">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>ACTA DE MATRIMONIO</label>
                        <input name="acta_matrimonio" class="form-control form-control-sm" type="file">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>PREDIAL</label>
                        <input name="predial" class="form-control form-control-sm" type="file">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>NO ADEUDO DE AGUA</label>
                        <input name="no_adeudo_agua" class="form-control form-control-sm" type="file">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>NO ADEUDO DE PREDIAL</label>
                        <input name="no_adeudo_predial" class="form-control form-control-sm" type="file">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>CÉDULA Y PLANO CATASTRAL ACTUALIZADO</label>
                        <input name="cedula_plano_catastral" class="form-control form-control-sm" type="file">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>COPIA DE LA ESCRITURA</label>
                        <input name="copia_escritura" class="form-control form-control-sm" type="file">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>REGLAMENTO DE CONDOMINOS Y NO ADEUDO DE CUOTAS EN SU CASO</label>
                        <input name="reglamento_condominios_no_adeudo" class="form-control form-control-sm" type="file">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-right pb-4">
            <button class="btn btn-primary">Guardar</button>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="{{ asset('vendor_assets/typeahead/typeahead.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

@endsection