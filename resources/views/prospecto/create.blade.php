@extends('layouts.master')
@section('title', 'PROSPECCION DE INMUEBLES')
@section('content')

<div class="container">   
    <div class="row justify-content-center mt-3">
        <div class="col-12 col-md-12 ">
            {{ Form::open(['route' => 'prospecto.store', 'method' => 'POST',  'files' => true]) }}
            <div class="card">                
                <input type="hidden" name="status" value="1">
                <div class="card-header">                    
                    <div class="d-flex align-items-center">
                        <h5 class="mr-auto">AGREGAR PROSPECIÓN DE INMUEBLE</h5>
                        <div>
                            <a href="/admin/prospecto" class="btn btn-success btn-sm  pull-right"><i class="fas fa-arrow-circle-left"></i> REGRESAR</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="small">NOMBRE</label>
                                <input type="text" class="form-control" name="nombre">
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('nombre')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label class="small">TELÉFONO</label>
                                <input name="phone" class="form-control" type="text">
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('phone')}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                <label class="small">UBICACIÓN</label>
                                <textarea name="ubicacion" class="form-control" cols="20" rows="1"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="small">COMPARTIDA</label>
                                <input type="checkbox" name="share" value="1">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label class="small">TIPO</label>
                                <select name="realstate_id" class="form-control form-control-sm">
                                    @foreach ($real_states as $real_state)
                                    <option value="{{ $real_state->id }}"> {{ $real_state->description }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label class="small">OPERACIÓN</label>
                                <select name="operation_id" class="form-control form-control-sm">
                                    @foreach ($operations as $operation)
                                    <option value="{{ $operation->id }}"> {{ $operation->description }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="small"> OBSERVACIÓN</label>
                                <textarea name="observation" class="form-control" cols="20" rows="1"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <label class="small">FOTOS</label>
                            <input name="image[]" class="form-control form-control-sm" multiple type="file">
                        </div>
                    </div>
                    <div class="row  mt-3">
                        <div class="col-12 text-right pb-4">
                            <button class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </div>                
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection