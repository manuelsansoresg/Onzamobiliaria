@extends('layouts.master')

@section('title', 'Clientes')

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-12 text-right">
            <a href="/admin/clientes" class="btn btn-success btn-sm  pull-right">
                <i class="fas fa-arrow-circle-left"></i> &nbsp; Regresar
            </a>
        </div>
    </div>

    <div class="row justify-content-center mt-3">
        <div class="col-12 col-md-8 ">
            {{ Form::open(['route' => 'clientes.store', 'method' => 'POST']) }}
            <div class="row">
                <div class="col-12">
                    <h5>Alta usuario</h5>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" name="nombre" class="form-control form-control-sm">
                        @if($errors)
                        <span class="text-danger"> {{$errors->first('nombre')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Correo</label>
                        <input type="email" name="correo" class="form-control form-control-sm">
                        @if($errors)
                        <span class="text-danger"> {{$errors->first('correo')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Teléfono</label>
                        <input type="text" name="telefono" class="form-control form-control-sm">
                        @if($errors)
                        <span class="text-danger"> {{$errors->first('telefono')}}</span>
                        @endif
                    </div>
                </div>
               
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Propietario</label>
                        <input type="checkbox" name="is_property" value="1">
                       
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-12 text-right">
                    <button class="btn btn-primary">Guardar</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection