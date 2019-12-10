@extends('layouts.master')
@section('title', 'FORMA DE PAGO')
@section('content')

<div class="container-fluid">
    <div class="row mt-3">       
        <div class="col-12 mt-3">
            @include('flash::message')
        </div>

    </div>
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h5 class="mr-auto">LISTADO DE FORMA DE PAGO</h5>
                    <div>
                        <a href="/admin/pago/create" class="btn btn-success btn-sm  pull-right"><i class="fas fa-plus-circle"></i> AGREGAR</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mt-3">
                    <div class="col-12 mt-3">
                        <table id="pagos" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>DESCRIPCIÓN</th>
                                    <th>STATUS</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($form_payments as $form_payment)
                                <tr>
                                    <td>{{ $form_payment->id  }}</td>
                                    <td>{{ $form_payment->description  }}</td>
                                    <td>
                                        @if($form_payment->status == 0)
                                        <i class="fas fa-ban text-danger"></i>
                                        <span>Inactivo</span>
                                        @else
                                        <i class="fas fa-ban text-success"></i>
                                        <span>Activo</span>
                                        @endif

                                    </td>
                                    <td>
                                        {{ Form::open(['route' => ['pago.destroy', $form_payment->id ],'class' => 'form-inline', 'method' => 'DELETE' ])}}
                                        <a href="{{route('pago.edit', $form_payment->id)}}" class="btn btn-primary">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        @if($form_payment->status == 0)
                                        <a href="/admin/pago/status/{{ $form_payment->id }}/1" class="btn btn-success">
                                            <i class="fas fa-ban text-white"></i>
                                        </a>
                                        @else
                                        <a href="/admin/pago/status/{{ $form_payment->id }}/0" class="btn btn-warning">
                                            <i class="fas fa-ban"></i>
                                        </a>
                                        @endif
                                        @role('admin')
                                        <button onclick="return confirm('¿Deseas eliminar el elemento?')" class="btn btn-danger">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                        @endrole
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(function() {

        $('#pagos').DataTable({
            "bSearchable": true,
            "bFilter": true,
            responsive: true,
            "pageLength": 10,

            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "BUSCAR:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
        })
    })
</script>
@endsection