@extends('adminlte::page')

@section('title', 'Seguimiento')

@section('content_header')
<section class="content-header">
    <h1>
        Seguimiento
        <small>Nuevo</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="/admin/seguimiento"><i class="fa fa-dashboard"></i> Seguimiento</a></li>
        <li class="active">Nuevo</li>
    </ol>
</section>
@stop
@section('content')
<div class="content">
    <div class="row">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Nuevo Seguimiento</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {{ Form::open(['route' => 'seguimiento.store', 'method' => 'POST', 'files' => true]) }}
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Descripción</label>
                                <input type="text" name="description" class="form-control">
                                <input type="hidden" name="status" value="1">
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('description')}}</span>
                                @endif
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