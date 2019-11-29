@extends('layouts.master')
@section('title', 'OPERACIONES')
@section('content')

<div class="container">
    <div class="row mt-3">
        <div class="col-12 text-right">
            <a href="/admin/operaciones" class="btn btn-success btn-sm  pull-right">
                <i class="fas fa-arrow-circle-left"></i> &nbsp; Regresar
            </a>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-12 col-md-8 ">
            {{ Form::open(['route' => ['operaciones.update', $operation->id], 'method' => 'PUT', 'files' => true]) }}
            <div class="card">
                <div class="card-header">EDITAR OPERACIONES</div>
                <div class="card-body">
                    <h5 class="card-title">DESCRIPCION</h5>
                    <div class="form-group">                        
                        <input type="text" name="description" value="{{ $operation->description }}" class="form-control">
                        <input type="hidden" name="status" value="{{ $operation->status }}">
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