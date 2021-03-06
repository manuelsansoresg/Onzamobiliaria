<@extends('adminlte::master')

@section('adminlte_css')
<link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@yield('css')
@stop

@section('body_class', 'login-page')

@section('body')


<h1>ONZA INMOBILIARIA</h1>
<!---728x90--->

    <div class=" w3l-login-form">
        <h2>INICIO DE SESSION</h2>
        <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
            {!! csrf_field() !!}

            <div class=" w3l-form-group">
                <label>USUARIO:</label>
                <div class="group">
                    <i class="fas fa-user"></i>
                    <input id="login" type="login" class="form-control" name="login" value="{{ old('login') }}" required autofocus placeholder="USUARIO">
                    @if ($errors->has('login'))
                    <span class="help-block">
                        <strong>{{ $errors->first('login') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class=" w3l-form-group">
                <label>CONTRASEÑA:</label>
                <div class="group">
                    <i class="fas fa-unlock"></i>
                    <input type="password" name="password" class="form-control" placeholder="{{ trans('adminlte::adminlte.password') }}">
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="forgot">                
                <p><input type="checkbox" nanme="remember"> RECORDAR CONTRASEÑA</p>
            </div>
            <button type="submit" >{{ trans('adminlte::adminlte.sign_in') }}</button>
        </form>        
    </div>
<!---728x90--->
	
    <footer>
        <p class="copyright-agileinfo"> &copy; 2019 Onza Inmobiliaria. Todos los derechos Reservados | Diseñado por <a href="https://xpertsystems.com.mx/">https://xpertsystems.com.mx</a></p>
    </footer>
    <!--
<div class="login-box">
    <div class="login-logo">
        <img src="{{ asset('img/logowithname.png') }}" alt="">
        {{-- <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a> --}}
    </div>
-->
    <!-- /.login-logo -->
    <!--
    <div class="login-box-body">
        <p class="login-box-msg">{{ trans('adminlte::adminlte.login_message') }}</p>
        <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
            {!! csrf_field() !!}

            <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                <input id="login" type="login" class="form-control" name="login" value="{{ old('login') }}" required autofocus placeholder="Introduce tu E-Mail o Nombre de Usuario">

                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('login'))
                <span class="help-block">
                    <strong>{{ $errors->first('login') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                <input type="password" name="password" class="form-control" placeholder="{{ trans('adminlte::adminlte.password') }}">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember"> {{ trans('adminlte::adminlte.remember_me') }}
                        </label>
                    </div>
                </div> -->

                <!-- /.col -->
                <!--
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('adminlte::adminlte.sign_in') }}</button>
                </div>
-->
                <!-- /.col -->
            <!--</div>
        </form>
        <div class="auth-links">

        </div>
    </div>-->
    <!-- /.login-box-body -->
<!--</div> --><!-- /.login-box -->
@stop

@section('adminlte_js')
<script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
<script>
    $(function() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
@yield('js')
@stop