@extends('layouts.master')

@section('title', 'CONFIRMACION')

@section('css')
<style type="text/css"> 
      body { margin: 0; border: 0; padding: 0; }
    
      #container{ 
        margin:0 auto;
        margin-top:60px;
        width:500px;
      }

      .info {
        padding: 5px;
        border: 1px solid #DEDEDE; 
        margin: 5px 0;
        background: #EFEFEF;
        color: #222222;
        text-align: center;
        -moz-box-shadow: 0 0 5px #888;
    -webkit-box-shadow: 0 0 5px#888;
    box-shadow: 0 0 5px #888;
    text-shadow: 2px 2px 2px #ccc;
    -webkit-border-radius: 15px;
    -moz-border-radius: 15px;
    border-radius: 15px;
      }
      
      .warning {
        padding: 5px;
        border: 1px solid #DEDEDE; 
        margin: 5px 0;      
        background: #FFFFCC;
        color: #222222;
        text-align: center;
      }
      
      .success {
        padding: 5px;
        border: 1px solid #349534; 
        margin: 5px 0;      
        background: #C9FFCA;
        color: #008000;
        font-weight: bold;
        text-align: center;
      }
      
      .error {
        padding: 5px;
        border: 1px solid #CC0000; 
        margin: 5px 0;      
        background: #F7CBCA;
        color: #CC0000;
        font-weight: bold;
        text-align: center;
      }
    </style> 
@stop

@section('content')
<div class="container-fluid">
    <div id="container" >
        <div class="info">
            <h1>¿Deseas eliminar el registro de {{ $property->pass_easy_broker }}? </h1>
            <form method="post" action="{{ route('propiedad.destroy', $property->id )}}">
                @method('DELETE')
                @csrf
        </br>
                <button type="submit" class="redondo btn btn-danger">
                    <i class="fas fa-trash-alt"></i> ELIMINAR
                </button>
                <a class="redondo btn btn-secondary" href="{{ route('cancelar') }}">
                <i class="fas fa-ban"></i> CANCELAR
            </a>
            </form>
        </div>
    </div>
</div>
@endsection
