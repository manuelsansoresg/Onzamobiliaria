@extends('layouts.master')

@section('title', 'Panel')

@section('content')
<div class="container">
    <div class="row mt-5 justify-content-center">
        @role('admin')

        <div class="col-12 col-md-3">
            <div class="card text-center">
                <a href="/admin/prospecto">
                    <i class="fas fa-box-open fa-3x mt-3 text-primary"></i>
                </a>
                <div class="card-body">
                    <h6 class="card-title">                        
                        <a href="/admin/prospecto" class="text-body"><span class="h6" >PROSPECCION DE INMUEBLES</span></a>                        
                    </h6>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="card text-center">
                <a href="/admin/propiedad">
                    <i class="fas fa-home fa-3x mt-3 text-primary"></i>
                </a>
                <div class="card-body">
                    <h5 class="card-title">

                        <a href="/admin/propiedad" class="text-body">
                            <span class="h6">PROPIEDADES</span>
                        </a>
                    </h5>

                </div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="card text-center">
                <a href="/admin/seguimiento-asesores">
                    <i class="fas fa-box-open fa-3x mt-3 text-primary"></i>
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="/admin/seguimiento-asesores" class="text-body">
                            <span class="h6">PROSPECTO VENTA/RENTA</span>
                        </a>
                    </h5>

                </div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="card text-center">
                <a href="/admin/catalogos">
                    <i class="fab fa-artstation fa-3x mt-3"></i>
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="/admin/catalogos" class="text-body">
                            <span class="h6">CATALOGOS</span>
                        </a>
                    </h5>

                </div>
            </div>
        </div>


        @endrole
        @role('asesor')

        <div class="col-12 col-md-2">
            <div class="card text-center">
                <a href="/admin/prospecto">
                    <i class="fas fa-box-open fa-3x mt-3 text-primary"></i>
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="/admin/prospecto" class="text-body">
                            <span class="h6">PROSPECCION DE INMUEBLES</span>
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
                    <i class="fas fa-box-open fa-3x mt-3 text-primary"></i>
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="/admin/seguimiento-asesores" class="text-body">
                            <span class="h6">PROSPECTO VENTA/RENTA</span>
                        </a>
                    </h5>

                </div>
            </div>
        </div>
        @endrole



    </div>
</div>
@endsection