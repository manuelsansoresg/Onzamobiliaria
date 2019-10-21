@extends('adminlte::page')

@section('title', 'Propiedad')

@section('adminlte_css')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content_header')
<section class="content-header">
    <h1>
        Propiedad
        <small>Editar </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="/admin/propiedad"><i class="fa fa-dashboard"></i> Propiedad</a></li>
        <li class="active">Editar </li>
    </ol>
</section>
@stop
@section('content')
<div class="content">
    <div class="row">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Editar Propiedad</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {{ Form::open(['route' => ['propiedad.update', $property->id], 'method' => 'PUT', 'id' => 'frm-property', 'files' => true]) }}

                <div class="container">

                    <!-- pasos -->
                    <div class="stepwizard col-md-offset-3">
                        <div class="stepwizard-row setup-panel">
                            <div class="stepwizard-step">
                                <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                                <p>Paso 1</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                                <p>Paso 2</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                                <p>Paso 3</p>
                            </div>
                        </div>
                    </div>
                    <!-- pasos -->
                    <div class="row setup-content" id="step-1">
                        <div class="col-xs-12 col-md-6 col-md-offset-3">
                            <div class="col-md-12">
                                <h3> Paso 1 / 3</h3>
                                <p class="margin"> <br> </p>

                            </div>

                            <p class="text-yellow">Los campos marcados con * son obligatorios</p>

                            <div class="col-md-12">

                                <label>*CP</label>

                                <div class="row">
                                    <div class="col-xs-9 col-md-6">
                                        <input type="text" name="cp" id="cp" value="{{ $postals['postal']->codigo }}" class="form-control">
                                        @if($errors)
                                        <span class="text-danger"> {{$errors->first('cp')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-xs-3 col-md-2 btn-cp">
                                        <button type="button" onclick="searchPostal()" class="btn btn-info btn-flat ">Buscar</button>
                                    </div>
                                </div>

                               

                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>*Colonia</label>
                                    <select name="colonia" id="colonia" class="form-control" >
                                        @foreach ($postals['postals'] as $postal)
                                            <option value="{{ $postal->id }}" {{ ( $postal->id == $property->postal_id)? 'selected' : '' }} >{{ $postal->colonia }}</option>
                                            
                                        @endforeach
                                    </select>
                                    @if($errors)
                                    <span class="text-danger"> {{$errors->first('colonia')}}</span>
                                    @endif
                                </div>
                                <p class="margin"> <br> </p>
                                <button id="nextOne" class="btn btn-primary nextBtn pull-right" type="button">Siguiente</button>
                            </div>

                        </div>
                    </div>

                    {{-- paso 2 --}}
                    <div class="row setup-content" id="step-2">
                        <div class="col-xs-12 col-md-6 col-md-offset-3">
                            <div class="col-md-12">
                                <h3> Paso 2 / 3</h3>
                                <p class="margin"> <br> </p>

                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Inmobiliaria</label>
                                    <select name="inmobiliaria" class="form-control">
                                        @foreach ($real_states as $real_state)
                                        <option value="{{ $real_state->id }}" {{ ( $property->realstate_id == $real_state->id )? 'selected' : ''  }} > {{ $real_state->description }} </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Operacion</label>
                                    <select name="operacion" class="form-control">
                                        @foreach ($operations as $operation)
                                        <option value="{{ $operation->id }}" {{ ($property->operation_id == $operation->id)? 'selected' : '' }} > {{ $operation->description }} </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Pago</label>
                                    <select name="pago" class="form-control">
                                        @foreach ($form_payments as $form_payment)
                                        <option value="{{ $form_payment->id }}" {{ ($property->form_pay_id == $form_payment->id ) ? 'selected' : '' }} > {{ $form_payment->description }} </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>


                            <div class="col-md-12">
                                <p class="margin"> <br> </p>
                                <button class="btn btn-primary prevBtn  pull-left" type="button">Anterior</button>
                                <button id="nextOne" class="btn btn-primary nextBtn pull-right" type="button">Siguiente</button>
                            </div>

                        </div>
                    </div>
                    {{-- paso 2 --}}

                    {{-- paso 3 --}}
                    <div class="row setup-content" id="step-3">
                        <div class="col-xs-12 col-md-6 col-md-offset-3">
                            <div class="col-md-12">
                                <h3> Paso 3 / 3</h3>

                                <p class="margin"> <br> </p>

                            </div>

                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label> Documento </label>
                                    @if ($property->document == '')
                                        <input type="file" name="documento" class="form-control">
                                    @else
                                       <p class="">
                                           <span><i class="fas fa-file  fa-2x"></i></span>
                                       </p>
                                       <p>
                                           <a href="/admin/propiedad/destroy-document/{{ $property->id }}" class="btn btn-danger">Borrar</a>
                                       </p>
                                    @endif
                                </div>
                            </div>


                            <div class="col-xs-12 col-md-3">
                                <div class="form-group">
                                    <label>Avaluo</label> &nbsp;
                                    <input type="checkbox" name="avaluo" value="1" {{ ($property->Avaluo == 1)? 'checked' : ''  }}>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-3">
                                <div class="form-group">
                                    <label>Gravamenes</label> &nbsp;
                                    <input type="checkbox" name="gravamenes" value="1" {{ ($property->assessment == 1)? 'checked' : '' }} >
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-3">
                                <div class="form-group">
                                    <label>Habitar</label> &nbsp;
                                    <input type="checkbox" name="habitar" value="1" {{ ($property->habitar == 1)? 'checked' : '' }} >
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-3">
                                <div class="form-group">
                                    <label>Propietario</label> &nbsp;
                                    <input type="checkbox" name="propietario" value="1" {{ ($property->is_property == 1)? 'checked' : '' }}>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label>Calle</label>
                                    <input type="text" class="form-control" name="calle" value="{{ $property->street }}">
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label>No interior</label>
                                    <input type="text" class="form-control" name="no_interior" value="{{ $property->noInt }}">
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label>No exterior</label>
                                    <input type="text" class="form-control" name="no_exterior" value="{{ $property->noExt }}">
                                </div>
                            </div>



                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label>Precio</label>
                                    <input name="precio" class="form-control" type="text" value="{{ $property->price }}">
                                </div>

                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label>Predial</label>
                                    <input name="predial" class="form-control" type="text" value="{{ $property->predial }}">
                                </div>

                            </div>


                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label>Institución</label>
                                    <input name="institucion" class="form-control" type="text" value="{{ $property->institution }}">
                                </div>

                            </div>


                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input name="nombre" class="form-control" type="text" value="{{ $property->name }}">
                                </div>

                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" class="form-control" type="text" value="{{ $property->email }}">
                                </div>

                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label>Teléfono</label>
                                    <input name="telefono" class="form-control" type="text" value="{{ $property->phone_contact }}">
                                </div>

                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label>Celular</label>
                                    <input name="celular" class="form-control" type="text" value="{{ $property->celular }}">
                                </div>

                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label>Celular 2 </label>
                                    <input name="celular2" class="form-control" type="text" value="{{ $property->celular2 }}">
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label> Observación </label>
                                    <textarea name="observacion" class="form-control" cols="30" rows="10">{{ $property->observation1 }}</textarea>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label> Observación 2 </label>
                                    <textarea name="observacion2" class="form-control" cols="30" rows="10">{{ $property->observation2 }}</textarea>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label> Observación 3 </label>
                                    <textarea name="observacion3" class="form-control" cols="30" rows="10">{{ $property->observation3 }}</textarea>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label> Habitaciones </label>
                                    <input name="habitacion" class="form-control" type="text" value="{{ $property->rooms }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label> Baños </label>
                                    <input name="banios" class="form-control" type="text" value="{{ $property->bathrooms }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label> Clave easybroke </label>
                                    <input name="clave_easybroke" class="form-control" type="text" value="{{ $property->pass_easy_broker }}">
                                </div>
                            </div>
                            {{-- <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" class="form-control" type="text">
                                </div>
                            
                            </div> --}}


                            <div class="col-md-12">
                                <p class="margin"> <br> </p>
                                <button class="btn btn-primary prevBtn  pull-left" type="button">Anterior</button>
                                <button id="property_save" class="btn btn-primary  pull-right" type="button">Guardar</button>
                            </div>

                        </div>
                    </div>
                    {{-- paso 3 --}}


                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop

@section('adminlte_js')
<script src="{{ asset('vendor_assets/typeahead/typeahead.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

@endsection