@extends('adminlte::page')

@section('title', 'Asignacion de Asesores')

@section('content_header')
<section class="content-header">
    <h1>
        Asignación de Asesores
        <small>Nuevo</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="/admin/seguimiento-asesores"><i class="fa fa-dashboard"></i> Seguimiento de asesores</a></li>
        <li><a href="/admin/seguimiento-asesores"><i class="fa fa-dashboard"></i> Lista </a></li>
        <li class="active">Nuevo</li>
    </ol>
</section>
@stop
@section('content')
<div class="content">
    <div class="row">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Nueva Asignacion</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {{ Form::open(['route' => 'seguimiento-asesores.store', 'method' => 'POST']) }}
                <input type="hidden" name="property_id" value="{{ $property_id }}">
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
                                <select class="form-control" name="status_follow_id" >
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