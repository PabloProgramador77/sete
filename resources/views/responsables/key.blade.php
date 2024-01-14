@extends('welcome')
@section('contenido')
<div class="content-wrapper" style="min-height: 1302.13px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edición de privada</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/responsables')}}">Responsables</a></li>
                        <li class="breadcrumb-item active">Edición de llaves</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title col-md-10">Modifica los datos como necesites.</h3>
                </div>
                <form role="form" id="formulario" novalidate enctype='multipart/form-data' >
                    @csrf
                    <div class="card-body">
                        
                        <div class="form-group">
                            <label for="key">*Llave Privada</label>
                            <input type="file" class="form-control" name="key" id="key" value="{{$llaves->nombreLlavePrivada}}">
                            <label for="key" class="form-control">Llave actual: {{$llaves->nombreLlavePrivada}}</label>
                        </div>
                        
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block" id="registrar"><b>Guardar cambios</b></button>
                        <a href="{{url('/')}}/llaves/password/{{$llaves->id}}" type="button" class="btn btn-secondary btn-block" ><b>Actualizar contraseña</b></a>
                    </div>
                    <input type="hidden" name="token" id="token" value="{{csrf_token()}}">
                    <input type="hidden" name="id" id="id" value="{{$llaves->idResponsable}}">
                    <input type="hidden" name="idLlave" id="idLlave" value="{{$llaves->id}}">
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/sweetAlert.js')}}"></script>
<script src="{{asset('js/jquery-3.6.js')}}" type="text/javascript"></script>
<script src="{{asset('js/llaves/verificarKey.js')}}" type="text/javascript"></script>
<script src="{{asset('js/llaves/actualizarKey.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#registrar").attr('disabled', true);
    });
</script>
@endsection