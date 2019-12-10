@extends('layouts.master')
@section('title', 'EDITAR USUARIO')
@section('content')

<div class="container">    
    <div class="row justify-content-center mt-3">
        <div class="col-12 col-md-8 ">
            {{ Form::open(['route' => ['usuarios.update', $user->id], 'method' => 'PUT']) }}
            <div class="card">
                <div class="card-header">                    
                    <div class="d-flex align-items-center">
                        <h5 class="mr-auto">EDITAR USUARIO</h5>
                        <div>
                            <a href="/admin/usuarios" class="btn btn-success btn-sm  pull-right"><i class="fas fa-arrow-circle-left"></i> REGRESAR</a>
                        </div>
                    </div>                
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="form-text text-muted">Los campos marcados con * son obligatorios</p>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">*Nombre</label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">

                                @if($errors)
                                <span class="text-danger"> {{$errors->first('name')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12"> </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">*Nick</label>
                                <input type="text" name="username" class="form-control" value="{{ $user->username }}">

                                @if($errors)
                                <span class="text-danger"> {{$errors->first('username')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12"> </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">*Email</label>
                                <input type="text" name="email" class="form-control" value="{{ $user->email }}">

                                @if($errors)
                                <span class="text-danger"> {{$errors->first('email')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12"> </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Easy Broker</label>
                                <input type="text" name="easy_broker" class="form-control" value="{{ $user->easy_broker }}">

                                @if($errors)
                                <span class="text-danger"> {{$errors->first('easy_broker')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12"> </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Permiso</label>
                                <select name="role" class="form-control">
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" {{ ($user_role == $role->name)? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-md-12"> </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">*Password</label>
                                <input type="password" name="password" class="form-control">

                                @if($errors)
                                <span class="text-danger"> {{$errors->first('password')}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <div class="form-group">
                                <button class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>           
            {{ Form::close() }}
        </div>    
    </div>
</div>
@endsection