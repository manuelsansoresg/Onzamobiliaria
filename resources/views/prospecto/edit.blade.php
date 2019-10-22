@extends('adminlte::page')

@section('title', 'Prospecto')

@section('adminlte_css')
<link rel="stylesheet" href="{{ asset('vendor_assets/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content_header')
<section class="content-header">
    <h1>
        Prospecto
        <small>Nuevo</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="/admin/prospecto"><i class="fa fa-dashboard"></i> Prospecto</a></li>
        <li class="active">Nuevo</li>
    </ol>
</section>
@stop



@section('content')
<div class="content">
    <div class="row">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Editar Prospecto</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                {{ Form::open(['route' => ['prospecto.update', $lead->id], 'method' => 'PUT', 'id' => 'frm-property']) }}

                <input type="hidden" name="status" value="{{ $lead->status }}">
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
                                        <input type="text" name="cp" id="cp" class="form-control" value="{{ $lead->codigo }}">
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
                                        <option value="{{ $postal->id }}" {{ ( $postal->id == $lead->postal_id)? 'selected' : '' }}>{{ $postal->colonia }}
                                        </option>
                                        
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
                                    <select name="realstate_id" class="form-control">
                                        @foreach ($real_states as $real_state)
                                        <option value="{{ $real_state->id }}" {{ ( $lead->realstate_id == $real_state->id )? 'selected' : ''  }}> {{ $real_state->description }} </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Operacion</label>
                                    <select name="operation_id" class="form-control">
                                        @foreach ($operations as $operation)
                                        <option value="{{ $operation->id }}" {{ ($lead->operation_id == $operation->id)? 'selected' : '' }}> {{ $operation->description }} </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Clasificación</label>
                                    <select name="clasification_id" class="form-control">
                                        @foreach ($clasifications as $clasification)
                                        <option value="{{ $clasification->id }}" {{ ($lead->clasification_id == $clasification->id)? 'selected' : '' }}> {{ $clasification->description }}
                                        </option>
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

                            <div class="col-xs-12 col-md-3">
                                <div class="form-group">
                                    <label>Compartida</label> &nbsp;
                                    <input type="checkbox" name="share" value="1" {{ ($lead->share == 1)? 'checked' : '' }}>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12"> </div>
                            <div class="col-md-4">
                                <label for="exampleInputEmail1">Fecha de asignación</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="date" value="{{ substr($lead->date, 0, 10) }}" autocomplete="off" class="form-control pull-right" id="datepicker">
                                </div>


                            </div>


                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label>Teléfono</label>
                                    <input name="phone" value="{{ $lead->phone }}" class="form-control" type="text">
                                </div>

                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label>Celular </label>
                                    <input name="mobile" value="{{ $lead->mobile }}" class="form-control" type="text">
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12"> </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label>Calle</label>
                                    <input type="text" value="{{ $lead->street }}" class="form-control" name="street">
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label>No interior</label>
                                    <input type="text" value="{{ $lead->n_in }}" class="form-control" name="n_in">
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label>No exterior</label>
                                    <input type="text" value="{{ $lead->n_out }}" class="form-control" name="n_out">
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label> Observación </label>
                                    <textarea name="obseration1" value="{{ $lead->obseration1 }}" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label> Observación 2 </label>
                                    <textarea name="observacion2" value="{{ $lead->obseration2 }}" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label> Observación 3 </label>
                                    <textarea name="observacion3" value="{{ $lead->obseration3 }}" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                            </div>


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
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('vendor_assets/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script>
    $(function() {
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        })
    })
</script>
<script src="{{ asset('vendor_assets/typeahead/typeahead.min.js') }}"></script>


@endsection