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
                {{ Form::open(['route' => 'seguimiento-asesores.store', 'method' => 'POST', 'id' => 'frm-property',  'files' => true]) }}
                <h5 class="card-header">PROSPECCIÓN DE INMUEBLES</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="small">NOMBRE</label>
                                <input type="text" class="form-control" name="nombre">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label class="small">TELÉFONO</label>
                                <input name="phone" class="form-control" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="row">                   
                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                <label class="small">UBICACIÓN</label>
                                <textarea name="observation2" class="form-control" cols="20" rows="1"></textarea>
                            </div>
                        </div>                    
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="small">COMPARTIDA</label>
                                <input type="checkbox" name="share" value="1">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label class="small">OPERACIÓN</label>
                                <select name="operation_id" class="form-control">
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
                                <textarea name="observation3" class="form-control" cols="20" rows="1"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <label class="small">FOTOS</label>
                            <input name="fotos" class="form-control form-control-sm" type="file">
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