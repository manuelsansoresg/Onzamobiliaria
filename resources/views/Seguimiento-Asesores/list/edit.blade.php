@extends('layouts.master')

@section('title', 'Historico seguimiento')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-3">
        <div class="col-12 col-md-8 ">
            {{ Form::open(['route' => ['historico-seguimiento.update', $historico->id], 'method' => 'PUT']) }}
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="mr-auto">EDITAR UN REGISTRO DE LLAMADA</h5>
                        <div>                    
                            <a href="/admin/historico-seguimiento/{{ $id_assigment }}" class="btn btn-success btn-sm  pull-right">
                                <i class="fas fa-arrow-circle-left"></i> REGRESAR
                            </a>                           
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <input type="hidden" name="property_assignment_id" value="{{ $id_assigment }}">                   
                    <div class="row mt-3">
                        <div class="col-12 col-md-8">
                            <div class="form-group">
                                <label for="exampleInputEmail1">ESTATUS SEGUIMIENTO</label>
                                <select name="status_follow_id" class="form-control form-control-sm">
                                    @foreach ($status_all as $status)
                                        <option value="{{ $status->id }}" {{ ($historico->status_follow_id ==  $status->id )? 'selected' : '' }}>{{ $status->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label class="small">FORMA DE PAGO</label>
                                    <select name="forma_pago[]" id="forma_pago" class="form-control form-control-sm" multiple="multiple">
                                        @foreach ($form_payments as $form_payment)
                                        <option value="{{ $form_payment->id }}" {{ ( in_array($form_payment->id, $my_payments) )? 'selected' : '' }}> {{ $form_payment->description }} </option>
                                        @endforeach
                                    </select>
                                    @if($errors)
                                    <div class="w-100"></div>
                                    <span class="text-danger"> {{$errors->first('form_pay_id')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="w-100"></div>
                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">OBSERVACIÓN</label>
                                <div class="w-100"></div>
                                <textarea name="observacion1" id="" cols="95" rows="10">{{ $historico->observacion1 }}</textarea>
                                @if($errors)
                                    <span class="text-danger"> {{$errors->first('observacion1')}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-12 text-right">
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

@section('content')
<div class="content d-none">
    <div class="row">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Nueva Asignacion</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">



                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Fecha</label>
                                {{-- <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="date" value="{{ date('Y-m-d', strtotime ($property_assigment->date)) }}" autocomplete="off" class="form-control pull-right" id="datepicker">
                            </div> --}}

                            @if($errors)
                            <span class="text-danger"> {{$errors->first('date')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status seguimiento</label>
                            <select class="form-control" name="status_follow_id">
                                {{-- @foreach ($status as $status)
                                    <option value="{{ $status->id }}" {{ ($property_assigment->status_follow_id ==  $status->id ) ? 'selected' : '' }}>{{ $status->description }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        {{-- <div class="form-group">
                                <label for="exampleInputEmail1">Nombre contacto</label>
                                <input type="text" name="name" value="{{ $property_assigment->name }}" class="form-control">

                        @if($errors)
                        <span class="text-danger"> {{$errors->first('name')}}</span>
                        @endif
                    </div> --}}
                    {{-- <div class="form-group">
                                <label> Observación 1 </label>
                                <textarea name="observation1" class="form-control" cols="30" rows="3"> {{ $property_assigment->observation1 }} </textarea>
                </div>
                <div class="form-group">
                    <label> Observación 2 </label>
                    <textarea name="observation2" class="form-control" cols="30" rows="3"> {{ $property_assigment->observation2 }} </textarea>
                </div>
                <div class="form-group">
                    <label> Observación 3 </label>
                    <textarea name="observation3" class="form-control" cols="30" rows="3"> {{ $property_assigment->observation3 }} </textarea>
                </div> --}}

            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <button class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>
</div>
</div>
</div>
@stop

@section('js')
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('vendor_assets/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script>
    $(function() {
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        })
    })
</script>
<script src="{{ asset('vendor_assets/typeahead/typeahead.min.js') }}"></script>


@endsection
