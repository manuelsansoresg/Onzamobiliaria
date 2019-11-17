@extends('layouts.master')

@section('title', 'Catalogos')

@section('content')
<div class="container">
    <div class="row mt-5 justify-content-center">
        @role('admin')

        <div class="col-12 col-md-2">
            <div class="card text-center">
                <a href="/admin/mobiliaria">                                        
                    <i class="fas fa-warehouse fa-3x mt-3 text-primary"></i>
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="/admin/mobiliaria" class="text-body">                        
                            <span class="h6">INMOBILIARIA</span>
                        </a>
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-2">
            <div class="card text-center">
                <a href="/admin/portales">                                                            
                    <i class="fas fa-archway fa-3x mt-3 text-primary"></i>
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="/admin/portales" class="text-body">                        
                            <span class="h6">PORTALES</span>
                        </a>
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-2">
            <div class="card text-center">
                <a href="/admin/operaciones">                                                                                
                    <i class="fas fa-tools fa-3x mt-3 text-primary"></i>
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="/admin/operaciones" class="text-body">                        
                            <span class="h6">OPERACIONES</span>
                        </a>
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-2">
            <div class="card text-center">
                <a href="/admin/clasificacion">                                                                                
                    <i class="fab fa-servicestack fa-3x mt-3 text-primary"></i>
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="/admin/clasificacion" class="text-body">                        
                            <span class="h6">CLASIFICACION</span>
                        </a>
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-2">
            <div class="card text-center">
                <a href="/admin/seguimiento">                                                                                                    
                    <i class="fab fa-typo3 fa-3x mt-3 text-primary"></i>
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="/admin/seguimiento" class="text-body " >                        
                            <span class="h6">EST. SEGMTO.</span>
                        </a>
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-2">
            <div class="card text-center">
                <a href="/admin/pago">                                                                                                                        
                    <i class="fas fa-dollar-sign fa-3x mt-3 text-primary"></i>
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="/admin/pago" class="text-body " >                        
                            <span class="h6">FORMA PAGO</span>
                        </a>
                    </h5>
                </div>
            </div>
        </div>
        @endrole

    </div>

</div>
@endsection