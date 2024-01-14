@extends('welcome')
@section('contenido')
<div class="content-wrapper" style="min-height: 1302.13px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edición de llave(s)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/responsables')}}">Responsables</a></li>
                        <li class="breadcrumb-item active">Edición de responsable</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title col-md-10">Modifica los datos como necesites. Los campos con etiqueta * son obligatorios.</h3>
                </div>
                <form role="form" id="formulario" novalidate enctype='multipart/form-data' >
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="passKey">*Contraseña de llave privada (Key)</label>
                            <input type="password" class="form-control" id="passKey" placeholder="Contraseña de acceso a la llave privada" value="{{$llaves->passLlavePrivada}}">
                        </div>
                        <div class="form-group">
                            <label for="confPassKey">*Confirmar contraseña</label>
                            <input type="password" class="form-control" id="confPassKey" placeholder="Confirma la contraseña" value="{{$llaves->passLlavePrivada}}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block" id="registrar"><b>Guardar cambios</b></button>
                    </div>
                    <input type="hidden" name="token" id="token" value="{{csrf_token()}}">
                    <input type="hidden" name="id" id="id" value="{{$llaves->id}}">
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/sweetAlert.js')}}"></script>
<script src="{{asset('js/jquery-3.6.js')}}" type="text/javascript"></script>
<script src="{{asset('js/llaves/confirmarPass.js')}}" type="text/javascript"></script>
<script src="{{asset('js/llaves/actualizarPass.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#registrar").attr('disabled', true);
    });
</script>
@endsection