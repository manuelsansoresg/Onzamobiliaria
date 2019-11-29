@extends('layouts.master')
@section('title', 'SEGUIMIENTO')
@section('content')

<div class="container">
    <div class="row mt-3">
        <div class="col-12 text-right">
            <a href="/admin/seguimiento" class="btn btn-success btn-sm  pull-right">
                <i class="fas fa-arrow-circle-left"></i> &nbsp; Regresar
            </a>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-12 col-md-8 ">
            {{ Form::open(['route' => ['seguimiento.update', $status_follow->id], 'method' => 'PUT', 'files' => true]) }}
            <div class="card">
                <div class="card-header">EDITAR SEGUIMIENTO</div>
                <div class="card-body">
                    <h5 class="card-title">DESCRIPCION</h5>
                    <div class="form-group">                        
                        <input type="text" name="description" value="{{ $status_follow->description }}" class="form-control">
                        <input type="hidden" name="status" value="{{ $status_follow->status }}">
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