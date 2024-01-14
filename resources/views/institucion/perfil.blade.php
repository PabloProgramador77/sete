@extends('welcome')
@section('contenido')
<div class="content-wrapper" style="min-height: 1302.13px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Perfil I.P.E.S.</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
                        <li class="breadcrumb-item active">Perfil I.P.E.S.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title col-md-10">Modifica los datos según lo creas conveniente</h3>
                </div>
                <form role="form" id="formulario" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nombre">*Nombre</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Federal, Estatal, etc." value="{{$institucion->nombreIpes}}">
                        </div>
                        <div class="form-group">
                            <label for="clave">*Clave</label>
                            <input type="text" class="form-control" id="clave" placeholder="Federal, Estatal, etc." value="{{$institucion->claveIpes}}">
                        </div>
                        <div class="form-group">
                            <label for="email">*Correo electrónico</label>
                            <input type="text" class="form-control" id="email" placeholder="Federal, Estatal, etc." value="{{$institucion->emailIpes}}">
                        </div>
                        <!--<div class="form-group">
                            <label for="plan">Plan</label>
                            <select name="plan" id="plan" class="form-control">
                                <option value="default">--Elige un plan--</option>
                                <option value="Basico">Básico</option>
                                <option value="Premium">Premium</option>
                                <option value="Ilimitado">Ilimitado</option>
                            </select>
                        </div>-->
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block" id="registrar"><b>Guardar cambios</b></button>
                    </div>
                    <input type="hidden" name="token" id="token" value="{{csrf_token()}}">
                    <input type="hidden" name="id" id="id" value="{{$institucion->id}}">
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/sweetAlert.js')}}"></script>
<script src="{{asset('js/jquery-3.6.js')}}" type="text/javascript"></script>
<script src="{{asset('js/instituciones/validarNombre.js')}}" type="text/javascript"></script>
<script src="{{asset('js/instituciones/validarClave.js')}}" type="text/javascript"></script>
<script src="{{asset('js/instituciones/validarEmail.js')}}" type="text/javascript"></script>
<script src="{{asset('js/instituciones/actualizar.js')}}" type="text/javascript"></script>
<script src="{{asset('js/instituciones/planes.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#registrar").attr('disabled', true);
    });
</script>
@endsection