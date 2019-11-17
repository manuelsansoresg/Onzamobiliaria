@extends('layouts.master')

@section('title', 'Catalogos')

@section('content')
<div class="container">
    <div class="row mt-5 justify-content-center">
        @role('admin')

        <div class="col-12 col-md-2">
            <div class="card text-center">
                <a href="/admin/clientes">
                    <i class="fas fa-box-open fa-3x mt-3 text-primary"></i>
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="/admin/clientes" class="text-body">
                            <span class="h6">PROSPECCION DE INMUEBLES</span>
                        </a>
                    </h5>

                </div>
            </div>
        </div>
        @endrole

    </div>

</div>
@endsection