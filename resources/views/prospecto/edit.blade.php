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
                    <p class="text-yellow">Los campos marcados con * son obligatorios</p>

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

                    <div class="col-xs-12 col-md-3">
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

                    <div class="col-xs-12 col-md-3">
                        <div class="form-group">
                            <label>No exterior</label>
                            <input type="text" value="{{ $lead->n_out }}" class="form-control" name="n_out">
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-11">
                        <h4 class="page-header"> </h4>
                    </div>

                    <div class="col-xs-12 col-md-3">
                        <div class="form-group">
                            <label>Compartida</label> &nbsp;
                            <input type="checkbox" name="share" value="1" {{ ($lead->share == 1)? 'checked' : '' }}>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12"> </div>

                    <div class="col-xs-12 col-md-4">
                        <div class="form-group">
                            <label>Inmobiliaria</label>
                            <select name="realstate_id" class="form-control">
                                @foreach ($real_states as $real_state)
                                <option value="{{ $real_state->id }}" {{ ( $lead->realstate_id == $real_state->id )? 'selected' : ''  }}> {{ $real_state->description }} </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="col-xs-12 col-md-4">
                        <div class="form-group">
                            <label>Operacion</label>
                            <select name="operation_id" class="form-control">
                                @foreach ($operations as $operation)
                                <option value="{{ $operation->id }}" {{ ($lead->operation_id == $operation->id)? 'selected' : '' }}> {{ $operation->description }} </option>
                                @endforeach
                            </select>
                        </div>

                    </div>


                    <div class="col-xs-12 col-md-3">
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

                    <div class="col-xs-12 col-md-4">

                        <label>*CP</label>

                        <div class="row">

                            <div class="col-xs-9 col-md-12">

                                <div class="input-group input-group-sm">
                                    <input type="text" name="cp" id="cp" value="{{ $lead->codigo }}" class="form-control">
                                    <span class="input-group-btn">
                                        <button type="button" onclick="searchPostal()" class="btn btn-info btn-flat ">Buscar</button>
                                    </span>
                                </div>

                            </div>

                            <div class="col-xs-12 col-md-12">
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('cp')}}</span>
                                @endif
                            </div>


                          
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-4">
                        <div class="form-group">
                            <label>*Colonia</label>
                            <select name="colonia" id="colonia" class="form-control">
                                @foreach ($postals['postals'] as $postal)
                                <option value="{{ $postal->id }}" {{ ( $postal->id == $lead->postal_id)? 'selected' : '' }}>{{ $postal->colonia }}
                                </option>

                                @endforeach
                            </select>
                            @if($errors)
                            <span class="text-danger"> {{$errors->first('colonia')}}</span>
                            @endif
                        </div>

                    </div>


                    <div class="col-xs-12 col-md-12"> </div>

                    <div class="col-xs-12 col-md-11">
                        <div class="form-group">
                            <label> Observación </label>
                            <textarea name="observation1" class="form-control" cols="30" rows="10">{{ $lead->observation1 }}</textarea>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-11">
                        <div class="form-group">
                            <label> Observación 2 </label>
                            <textarea name="observation2" class="form-control" cols="30" rows="10">{{ $lead->observation2 }}</textarea>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-11">
                        <div class="form-group">
                            <label> Observación 3 </label>
                            <textarea name="observation3" class="form-control" cols="30" rows="10">{{ $lead->observation3 }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-11">
                        <p class="margin"> </p>

                        <button class="btn btn-primary pull-right " type="submit">Guardar</button>
                    </div>

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