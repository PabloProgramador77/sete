@extends('welcome')
@section('contenido')
<div class="content-wrapper" style="min-height: 1302.13px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Eliminación de cargo(s)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/cargos')}}">Cargo de responsables</a></li>
                        <li class="breadcrumb-item active">Eliminar cargo</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title col-md-10">Confirma que sea el registro correcto.</h3>
                </div>
                <form role="form" id="formulario" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="numeroControl">*Nombre</label>
                            <input type="text" class="form-control" id="nombre" readonly value="{{$cargo->nombreCargo}}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block" id="registrar"><b>Eliminar</b></button>
                    </div>
                    <input type="hidden" name="token" id="token" value="{{csrf_token()}}">
                    <input type="hidden" name="id" id="id" value="{{$cargo->id}}">
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/sweetAlert.js')}}"></script>
<script src="{{asset('js/jquery-3.6.js')}}" type="text/javascript"></script>
<script src="{{asset('js/cargos/eliminar.js')}}" type="text/javascript"></script>
@endsection