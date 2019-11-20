@extends('layouts.master')

@section('title', 'Asignacion de Asesores')

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-12 text-right">
            <a href="/admin/seguimiento-asesores" class="btn btn-success btn-sm  pull-right">
                <i class="fas fa-arrow-circle-left"></i> &nbsp; Regresar
            </a>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-12 col-md-8 ">
            {{ Form::open(['route' => 'seguimiento-asesores.store', 'method' => 'POST', 'files' => true]) }}
            <div class="card">
                <div class="card-header">.:: Nueva Asignacion ::.</div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="input-group mb-2">
                                <label class="small">EASY BROKER</label>
                                <div class="w-100"></div>
                                <input type="text" name="easy_broker" id="easy_broker" class="form-control form-control-sm">
                                <div class="input-group-prepend">
                                    <button type="button" onclick="searchEasyBroker()" class="btn btn-info btn-sm">Buscar</button>
                                </div>
                                @if($errors)
                                <div class="w-100"></div>
                                <span class="text-danger" id="error_easy"> {{$errors->first('easy_broker')}}</span>
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <span class="font-weight-bold">DATOS GENERALES</span>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-5 col-md-2">
                            <span class="font-weight-bold small"> PROPIEDAD: </span>
                        </div>
                        <div class="col-7 col-md-4">
                            <span class="small text-uppercase" id="val_propiedad"></span>
                        </div>

                        <div class="col-5 col-md-2">
                            <span class="font-weight-bold small"> OPERACIÓN: </span>
                        </div>
                        <div class="col-7 col-md-4">
                            <span class="small text-uppercase" id="val_operacion"></span>
                        </div>


                        <div class="col-5 col-md-2">
                            <span class="font-weight-bold small"> COLONIA: </span>
                        </div>
                        <div class="col-7 col-md-4">
                            <span class="small text-uppercase" id="val_colonia"></span>
                        </div>

                        <div class="col-5 col-md-2">
                            <span class="font-weight-bold small"> ASESOR: </span>
                        </div>
                        <div class="col-7 col-md-4">
                            <span class="small text-uppercase" id="val_asesor"></span>
                        </div>

                        <div class="col-5 col-md-2">
                            <span class="font-weight-bold small"> PRECIO: </span>
                        </div>
                        <div class="col-7 col-md-4">
                            <span class="small text-uppercase" id="val_precio"></span>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <span class="font-weight-bold">COMPLEMENTARIO</span>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">Portal</label>
                                <select name="add_id" class="form-control">
                                    @foreach ($ads as $ad)
                                    <option value="{{ $ad->id }}">{{ $ad->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">Nombre Prospecto</label>
                                <input type="text" name="nombre" class="form-control">
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('nombre')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">Teléfono</label>
                                <input type="text" name="telefono" class="form-control">
                            </div>
                            @if($errors)
                            <span class="text-danger"> {{$errors->first('telefono')}}</span>
                            @endif
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">Correo</label>
                                <input type="email" name="correo" class="form-control">
                            </div>
                            @if($errors)
                            <span class="text-danger"> {{$errors->first('correo')}}</span>
                            @endif
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">Asesor</label>
                                <select name="asesor_id" class="form-control" id="">
                                    @foreach ($asesores as $asesor)
                                    <option value="{{ $asesor->id }}">{{ $asesor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-right">
                        <button class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>


<div class="content d-none">
    <div class="row">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Nueva Asignacion</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {{ Form::open(['route' => 'seguimiento-asesores.store', 'method' => 'POST']) }}
                <input type="hidden" name="status" value="1">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Fecha</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="date" autocomplete="off" class="form-control pull-right" id="datepicker">
                                </div>

                                @if($errors)
                                <span class="text-danger"> {{$errors->first('date')}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Status seguimiento</label>
                                <select class="form-control" name="status_follow_id">
                                    @foreach ($status as $status)
                                    <option value="{{ $status->id }}">{{ $status->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre contacto</label>
                                <input type="text" name="name" class="form-control">

                                @if($errors)
                                <span class="text-danger"> {{$errors->first('name')}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label> Observación 1 </label>
                                <textarea name="observation1" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label> Observación 2 </label>
                                <textarea name="observation2" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label> Observación 3 </label>
                                <textarea name="observation3" class="form-control" cols="30" rows="3"></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group pull-right">
                                <button class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
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