@extends('layouts.master')

@section('title', 'FORMA DE PAGO')

@section('content')
<div class="container">    
    <div class="row justify-content-center mt-3">
        <div class="col-12 col-md-8 ">
        {{ Form::open(['route' => 'pago.store', 'method' => 'POST', 'files' => true]) }}
        <div class="card">
            <div class="card-header">                
                <div class="d-flex align-items-center">
                    <h5 class="mr-auto">AGREGAR FORMA DE PAGO</h5>
                    <div>
                        <a href="/admin/pago" class="btn btn-success btn-sm  pull-right"><i class="fas fa-arrow-circle-left"></i> REGRESAR</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">DESCRIPCION</h5>
                <div class="form-group">
                    <input type="text" name="description" class="form-control">
                    <input type="hidden" name="status" value="1">
                    @if($errors)
                    <span class="text-danger"> {{$errors->first('description')}}</span>
                    @endif
                </div>
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