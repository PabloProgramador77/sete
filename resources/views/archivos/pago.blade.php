@extends('welcome')
@section('contenido')
<div class="content-wrapper" style="min-height: 1302.13px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Archivos XML</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/archivos')}}">Archivos XML</a></li>
                        <li class="breadcrumb-item active">Pago de XML</li>
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
                <div class="col-12 m-auto bg-light">
                    <p class="p-3 fs-6 fw-semibold">Una vez realizado el pago, usted podrá descargar el archivo XML, con el cual podrá tramitar el título electrónico del egresado.</p>
                </div>
                <form role="form" id="formulario" novalidate >
                    @csrf
                    <div class="card-body">
                        <div class="form-group col-6" style="float: left;">
                            <label for="folio">Folio</label>
                            <input type="text" class="form-control" id="folio" value="{{$archivo->folioArchivo}}" readonly="true">
                        </div>
                        <div class="form-group col-6" style="float: left;">
                            <label for="precio">Precio</label>
                            <input type="text" class="form-control" id="precio" readonly="true" value="1140">
                        </div>
                        <div class="form-group" >
                            <label for="descripcion">Descripción</label>
                            <input type="text" class="form-control" id="descripcion" readonly="true" value="Pago de archivo XML">
                        </div>
                        <div class="form-group">
                            <label for="tarjeta">* Número de Tarjeta</label>
                            <input type="text" class="form-control" id="tarjeta" placeholder="Ej: 0987123467894321" required>
                        </div>
                        <div class="form-group" style="width: 32.5%; float:left;">
                            <label for="mes">* Mes de Expiración</label>
                            <input type="text" class="form-control" id="mes" placeholder="Ej: 01" required>
                        </div>
                        <div class="form-group" style="width: 32.5%; float:left;">
                            <label for="ano">* Año de Expiración</label>
                            <input type="text" class="form-control" id="ano" placeholder="Ej: 24" required>
                        </div>
                        <div class="form-group" style="width: 32.5%; float:left;">
                            <label for="cvc">* CVC</label>
                            <input type="text" class="form-control" id="cvc" placeholder="Ej: 464" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block" id="registrar"><b>Pagar Archivo XML</b></button>
                    </div>
                    <input type="hidden" name="token" id="token" value="{{csrf_token()}}">
                    <input type="hidden" name="idArchivo" id="idArchivo" value="{{$archivo->id}}">
                    
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/sweetAlert.js')}}"></script>
<script src="{{asset('js/jquery-3.6.js')}}" type="text/javascript"></script>
<script src="{{asset('js/archivos/pago.js')}}" type="text/javascript"></script>
@endsection