@extends('layouts.master')
@section('title', 'PROSPECCION DE INMUEBLES')
@section('content')

<div class="container">
    <div class="row mt-3">
        <div class="col-12 text-right">
            <a href="/admin/prospecto" class="btn btn-success btn-sm  pull-right">
                <i class="fas fa-arrow-circle-left"></i> &nbsp; Regresar
            </a>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-12 col-md-12 ">
            <div class="card">

                {{ Form::open(['route' => ['prospecto.update', $lead->id], 'method' => 'PUT', 'files' => true]) }}
                <input type="hidden" name="status" value="1">
                <h5 class="card-header">PROSPECCIÓN DE INMUEBLES</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="small">NOMBRE</label>
                                <input type="text" class="form-control" name="nombre" value="{{ $lead->nombre }}">
                                @if($errors)
                                <span class="text-danger"> {{$errors->first('nombre')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label class="small">TELÉFONO</label>
                                <input name="phone" class="form-control" type="text" value="{{ $lead->phone }}">
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
                                <textarea name="ubicacion" class="form-control" cols="20" rows="1">{{ $lead->ubicacion }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="small">COMPARTIDA</label>
                                @if ($lead->share == 1)
                                    <input type="checkbox" name="share" value="1" checked>
                                    @else
                                    <input type="checkbox" name="share" value="1">
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label class="small">OPERACIÓN</label>
                                <select name="operation_id" class="form-control">
                                    @foreach ($operations as $operation)
                                    <option value="{{ $operation->id }}" {{ ($lead->operation_id == $operation->id)? 'selected' : '' }}> {{ $operation->description }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="small"> OBSERVACIÓN</label>
                                <textarea name="observation" class="form-control" cols="20" rows="1">{{ $lead->observation }}</textarea>
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
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection