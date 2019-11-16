@extends('layouts.master')

@section('title', 'Metodo Pago')
@section('content')

<div class="container">
    <div class="row mt-3">
        <div class="col-12 text-right">
            <a href="/admin/pago" class="btn btn-success btn-sm  pull-right">
                <i class="fas fa-arrow-circle-left"></i> &nbsp; Regresar
            </a>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-12 col-md-8 ">
            {{ Form::open(['route' => ['pago.update', $form_payment->id], 'method' => 'PUT', 'files' => true]) }}
            <div class="row">
                <div class="col-12">
                    <h5>Nuevo Metodo Pago</h5>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Descripción</label>
                        <input type="text" name="description" value="{{ $form_payment->description }}" class="form-control">
                        <input type="hidden" name="status" value="{{ $form_payment->status }}">
                        @if($errors)
                        <span class="text-danger"> {{$errors->first('description')}}</span>
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