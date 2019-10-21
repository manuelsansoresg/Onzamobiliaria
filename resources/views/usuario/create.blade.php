@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
<section class="content-header">
    <h1>
        Usuarios
        <small>Nuevo</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="/admin/usuarios"><i class="fa fa-dashboard"></i> Usuarios</a></li>
        <li class="active">Nuevo</li>
    </ol>
</section>
@stop
@section('content')
<div class="content">
    <div class="row">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Nuevo usuario</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {{ Form::open(['route' => 'usuarios.store', 'method' => 'POST', 'files' => true]) }}
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-yellow">Los campos marcados con * son obligatorios</p>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">*Nombre</label>
                                <input type="text" name="name" class="form-control">

                                @if($errors)
                                <span class="text-danger"> {{$errors->first('name')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12"> </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">*Nick</label>
                                <input type="text" name="username" class="form-control">

                                @if($errors)
                                <span class="text-danger"> {{$errors->first('username')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12"> </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">*Email</label>
                                <input type="text" name="email" class="form-control">

                                @if($errors)
                                <span class="text-danger"> {{$errors->first('email')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12"> </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Easy Broker</label>
                                <input type="text" name="easy_broker" class="form-control">

                                @if($errors)
                                <span class="text-danger"> {{$errors->first('easy_broker')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12"> </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Permiso</label>
                                <select name="role" class="form-control" >
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                              
                            </div>
                        </div>
                        <div class="col-md-12"> </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">*Password</label>
                                <input type="password" name="password" class="form-control">

                                @if($errors)
                                <span class="text-danger"> {{$errors->first('password')}}</span>
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