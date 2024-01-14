@extends('welcome')
@section('contenido')
<div class="content-wrapper" style="min-height: 1302.13px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Nuevo archivo XML</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/archivos')}}">Archivos</a></li>
                        <li class="breadcrumb-item active">Nuevo archivo</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title col-md-10">Campos con simbolo * son obligatorios</h3>
                </div>
                <form role="form" id="formulario" novalidate>
                    @csrf
                    <div class="card-body">
                        @if ($expedicion->folioArchivo!='')
                            <div class="form-group">
                                <label for="folio">*Folio</label>
                                <input type="text" class="form-control" id="folio" placeholder="1, 01, 001, 0001, etc." required value="{{$expedicion->folioArchivo}}" readonly="true">
                            </div>
                        @else
                            <div class="form-group">
                                <label for="folio">*Folio</label>
                                <input type="text" class="form-control" id="folio" placeholder="1, 01, 001, 0001, etc." required>
                            </div>    
                        @endif
                        
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block" id="registrar"><b>Crear archivo</b></button>
                    </div>
                    <input type="hidden" name="token" id="token" value="{{csrf_token()}}">
                    <input type="hidden" name="idExpedicion" id="idExpedicion" value="{{$expedicion->id}}">
                    
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/sweetAlert.js')}}"></script>
<script src="{{asset('js/jquery-3.6.js')}}" type="text/javascript"></script>
<script src="{{asset('js/archivos/verificarFolio.js')}}" type="text/javascript"></script>
@if ($expedicion->folioArchivo!='')
    <script src="{{asset('js/archivos/actualizar.js')}}" type="text/javascript"></script>
@else
    <script src="{{asset('js/archivos/registrar.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#registrar").attr('disabled', true);
        });
    </script>    
@endif

@endsection