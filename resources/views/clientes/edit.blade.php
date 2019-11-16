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
            {{ Form::open(['route' => ['clientes.update', $client->id], 'method' => 'PUT']) }}
            <div class="row">
                <div class="col-12">
                    <h5>Alta usuario</h5>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" name="nombre" value="{{ $client->nombre }}" class="form-control form-control-sm">
                        @if($errors)
                        <span class="text-danger"> {{$errors->first('nombre')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Correo</label>
                        <input type="email" name="correo" value="{{ $client->correo }}" class="form-control form-control-sm">
                        @if($errors)
                        <span class="text-danger"> {{$errors->first('correo')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Teléfono</label>
                        <input type="text" name="telefono" value="{{ $client->telefono }}" class="form-control form-control-sm">
                        @if($errors)
                        <span class="text-danger"> {{$errors->first('telefono')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Medio por el que nos contacto</label>
                        <input type="text" name="medio_contacto" value="{{ $client->medio_contacto }}" class="form-control form-control-sm">
                        @if($errors)
                        <span class="text-danger"> {{$errors->first('medio_contacto')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Propiedad de interes</label>
                        <input type="text" name="propiedad_interes" value="{{ $client->propiedad_interes }}" class="form-control form-control-sm">
                        @if($errors)
                        <span class="text-danger"> {{$errors->first('propiedad_interes')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Precio</label>
                        <input type="text" name="precio" value="{{ $client->precio }}" class="form-control form-control-sm">
                        @if($errors)
                        <span class="text-danger"> {{$errors->first('precio')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Título de la propiedad</label>
                        <input type="text" name="titulo_propiedad" value="{{ $client->titulo_propiedad }}" class="form-control form-control-sm">
                        @if($errors)
                        <span class="text-danger"> {{$errors->first('titulo_propiedad')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Clave interna</label>
                        <input type="text" name="clave_interna" value="{{ $client->clave_interna }}" class="form-control form-control-sm">
                        @if($errors)
                        <span class="text-danger"> {{$errors->first('clave_interna')}}</span>
                        @endif
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