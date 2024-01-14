@extends('welcome')
@section('contenido')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Registro de IPES</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Registro</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row p-2">
                <div class="col-12 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title col-md-10">Registro de IPES</h3>
                        </div>
                        <div class="card-body">
                            <p class="fs-4 fw-normal">Por favor captura los datos de tu IPES (Institucion Privada de Educación Superior) en el siguiente 
                                formulario. Lo campos con etiqueta * son obligatorios.
                            </p>
                            <form class="row form-group" novalidate>
                                @csrf
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label for="nombre">*Nombre</label>
                                        <input type="text" class="form-control" id="nombre" required placeholder="Ejemplo: Colegio de San Francisco, Universidad de Guanajuato, etc.">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="clave">*Clave</label>
                                        <input type="text" class="form-control" id="clave" required placeholder="110378, 032691, etc.">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="email">*Correo electrónico</label>
                                        <input type="email" class="form-control" id="email" required placeholder="universidad.gto@gob.mx, colegio.sfc@gmail.com, etc.">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label for="pass">*Contraseña</label>
                                        <input type="password" class="form-control" id="pass" required placeholder="Combina letras minúsculas, mayúsculas, números y caracteres especiales">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="passConf">*Confirmar contraseña</label>
                                        <input type="password" class="form-control" id="passConf" required placeholder="Confirma la contraseña capturada.">
                                    </div>
                                </div>
                                <div class="col-6 m-auto">
                                    <div class="col-8 m-auto">
                                        <button type="submit" class="btn btn-primary btn-block my-1" id="registrar">Registrar</button>
                                    </div>
                                    <div class="col-8 m-auto">
                                        <a href="{{url('/login')}}" role="submit" class="btn btn-secondary btn-block my-1" >Ya tengo cuenta</a>
                                    </div>
                                </div>
                                <input type="hidden" name="token" id="token" value="{{csrf_token()}}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/sweetAlert.js')}}"></script>
<script src="{{asset('js/jquery-3.6.js')}}" type="text/javascript"></script>
<script src="{{asset('js/instituciones/validarNombre.js')}}" type="text/javascript"></script>
<script src="{{asset('js/instituciones/validarClave.js')}}" type="text/javascript"></script>
<script src="{{asset('js/instituciones/validarEmail.js')}}" type="text/javascript"></script>
<script src="{{asset('js/instituciones/validarPass.js')}}" type="text/javascript"></script>
<script src="{{asset('js/instituciones/registrar.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#registrar").attr('disabled', true);
    });
</script>
@endsection