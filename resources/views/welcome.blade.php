@extends('layouts.master')

@section('title', 'Panel')

@section('content')
<div class="container">
    <div class="row mt-5 justify-content-center">
        @role('admin')

        <div class="col-12 col-md-2">
            <div class="card text-center">
                <a href="/admin/pago">
                    <i class="fas fa-hand-holding-usd fa-3x mt-3"></i>
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="" class="text-body">
                            <span class="h6">METODO PAGO</span>
                        </a>
                    </h5>

                </div>
            </div>
        </div>

        <div class="col-12 col-md-2">
            <div class="card text-center">
                <a href="/admin/clientes">
                    <i class="fas fa-box-open fa-3x mt-3 text-primary"></i>
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="/admin/clientes" class="text-body">
                            <span class="h6">CLIENTES</span>
                        </a>
                    </h5>

                </div>
            </div>
        </div>

        <div class="col-12 col-md-2">
            <div class="card text-center">
                <a href="/admin/propiedad">
                    <i class="fas fa-home fa-3x mt-3 text-primary"></i>
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="" class="text-body">
                        <span class="h6">PROPIEDADES</span>
                        </a>
                    </h5>

                </div>
            </div>
        </div>

        <div class="col-12 col-md-2">
            <div class="card text-center">
                <a href="/admin/seguimiento-asesores">
                    <i class="fas fa-clipboard fa-3x mt-3 text-primary"></i>
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="" class="text-body">
                        <span class="h6">SEGUIMIENTOS</span>
                        </a>
                    </h5>

                </div>
            </div>
        </div>
        @endrole
        @role('asesor')
        <div class="col-12 col-md-2">
            <div class="card text-center">
                <a href="/admin/clientes">
                    <i class="fas fa-box-open fa-3x mt-3 text-primary"></i>
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="/admin/clientes" class="text-body">Clientes</a>
                    </h5>

                </div>
            </div>
        </div>

        <div class="col-12 col-md-2">
            <div class="card text-center">
                <a href="/admin/seguimiento-asesores">
                    <i class="fas fa-clipboard fa-3x mt-3 text-primary"></i>
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="" class="text-body">
                            Seguimiento
                        </a>
                    </h5>

                </div>
            </div>
        </div>

        @endrole



    </div>
</div>
@endsection