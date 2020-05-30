<html lang="en">
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Font Awesome -->
    <link rel="icon"   href="{{ asset('img/logo.png') }}" type="image/png" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor_assets/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor_assets/DataTables/DataTables-1.10.20/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor_assets/DataTables/DataTables-1.10.20/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor_assets/DataTables/Buttons-1.6.1/css/buttons.dataTables.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
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
                    <span class="text-white">
                        <i class="fas fa-user"></i>
                        {!! Auth::user()->name !!}
                    </span>
                </li>
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




    @yield('content')

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{ asset('vendor_assets/sark-decimal/sark-decimal.js') }}"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('vendor_assets/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('vendor_assets/DataTables/DataTables-1.10.20/js/dataTables.jqueryui.min.js') }}"></script>
    <script src="{{ asset('vendor_assets/DataTables/DataTables-1.10.20/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor_assets/DataTables/Buttons-1.6.1/js/dataTables.buttons.js') }}"></script>   


   

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.min.js"></script>
    <script src="{{ asset('vendor_assets/jquery.infiniteScroll.js') }}"></script>


    <script src="{{ asset('js/admin.js') }}"></script>
    @yield('js')
</body>

</html>