@extends('layouts.master')

@section('title', 'Clientes')

@section('content')
<div class="container">    
    <div class="row justify-content-center mt-3">
        <div class="col-12 col-md-8 ">
            {{ Form::open(['route' => ['clientes.update', $client->id], 'method' => 'PUT']) }}
            <div class="card">
                <div class="card-header">                    
                    <div class="d-flex align-items-center">
                        <h5 class="mr-auto">EDITAR CLIENTE</h5>
                        <div>
                            <a href="/admin/clientes" class="btn btn-success btn-sm  pull-right"><i class="fas fa-arrow-circle-left"></i> REGRESAR</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1"  class="small">NOMBRE</label>
                                <input type="text" name="nombre" value="{{ $client->nombre }}" class="form-control form-control-sm">
                                @if($errors)
                                    <span class="text-danger"> {{$errors->first('nombre')}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"  class="small">EMAIL</label>
                                <input type="email" name="correo" value="{{ $client->correo }}" class="form-control form-control-sm">
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('correo')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1"  class="small">TELÉFONO</label>
                                <input type="text" name="telefono" value="{{ $client->telefono }}" class="form-control form-control-sm">
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('telefono')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1"  class="small">TELÉFONO 2</label>
                                <input type="text" name="telefono2" value="{{ $client->telefono2 }}" class="form-control form-control-sm">
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('telefono2')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1"  class="small">TELÉFONO 2</label>
                                <input type="text" name="telefono3" value="{{ $client->telefono3 }}" class="form-control form-control-sm">
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('telefono3')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1"  class="small">¿ES PROPIETARIO?</label>
                                @if ($client->is_property == 1)
                                    <input type="checkbox" name="is_property" value="1" checked>
                                    @else
                                    <input type="checkbox" name="is_property" value="1">
                                @endif        
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-right">
                        <button class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection