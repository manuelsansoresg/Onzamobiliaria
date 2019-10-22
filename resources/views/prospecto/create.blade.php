@extends('adminlte::page')

@section('title', 'Prospecto')

@section('adminlte_css')
<link rel="stylesheet" href="{{ asset('vendor_assets/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
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
                <h3 class="box-title">Nuevo Prospecto</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {{ Form::open(['route' => 'prospecto.store', 'method' => 'POST', 'files' => true]) }}
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Fecha de asignación</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="datepicker">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Fecha de asignación</label>
                                <input type="text" name="date" class="form-control pull-right" id="datepicker">
                                <input type="hidden" name="status" value="1">
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('description')}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
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

@section('adminlte_js')
<script src="{{ asset('vendor_assets/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $(function () {
            $('#datepicker').datepicker({
            autoclose: true
            })
        })
    </script>
@endsection