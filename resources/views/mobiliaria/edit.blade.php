@extends('adminlte::page')

@section('title', 'Inmobiliaria')

@section('content_header')
<section class="content-header">
    <h1>
        Mobiliaria
        <small>Editar</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="/admin/mobiliaria"><i class="fa fa-dashboard"></i> Inmobiliaria</a></li>
        <li class="active">Editar</li>
    </ol>
</section>
@stop
@section('content')
<div class="content">
    <div class="row">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Editar Inmobiliaria</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {{ Form::open(['route' => ['mobiliaria.update', $real_state->id], 'method' => 'PUT', 'files' => true]) }}
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Descripción</label>
                                <input type="text" name="description" value="{{ $real_state->description }}" class="form-control">
                                <input type="hidden" name="status" value="{{ $real_state->status }}">
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