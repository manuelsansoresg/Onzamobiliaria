<html lang="en">
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor_assets/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor_assets/DataTables/Responsive-2.2.3/css/responsive.bootstrap.min.css') }}">
    @yield('css')
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand">
            <img class="logo" src="{{ asset('img/logo.png') }}" alt="">
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="form-inline">
            @csrf
            <ul class="list-inline mt-2">
                <li class="list-inline-item">
                    <a href="/home" class="btn btn-outline-primary btn-sm text-white">
                        <i class="fas fa-home"></i>
                        Inicio
                    </a>
                </li>
                <li class="list-inline-item">
                    <button class="btn btn-outline-success my-2 my-sm-0 btn-sm" type="submit"> <i class="fas fa-sign-out-alt"></i>
                        Salir</button>
                </li>

            </ul>
        </form>
    </nav>

    <div class="container">
        <div class="row mt-3">
            <div class="col-12 text-right">
                <span class="">Bienvenido</span> <span class="font-weight-bold">{!! Auth::user()->name !!}</span>
            </div>
        </div>
    </div>


    @yield('content')

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('vendor_assets/DataTables/datatables.min.js') }}"></script>
    @yield('js')
</body>

</html>