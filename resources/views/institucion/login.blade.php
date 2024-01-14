@extends('welcome')
@section('contenido')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Identificación de IPES</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Acceso</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row p-2">
                <div class="col-10 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title col-md-10">Identificación de IPES</h3>
                        </div>
                        <div class="card-body">
                            <p class="fs-4 fw-normal">Por favor captura los datos de acceso tu IPES (Institucion Privada de Educación Superior) en el siguiente 
                                formulario. Lo campos con etiqueta * son obligatorios.
                            </p>
                            <form class="row form-group" novalidate>
                                @csrf
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label for="email">*Correo electrónico</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="pass">*Contraseña</label>
                                        <input type="password" class="form-control" id="pass" name="pass" required>
                                    </div>
                                </div>
                                <div class="col-6 m-auto">
                                    <div class="col-8 m-auto">
                                        <button type="submit" class="btn btn-primary btn-block my-4" id="registrar">Entrar</button>
                                    </div>
                                    <div class="col-8 m-auto">
                                        <a href="{{url('/registro')}}" role="submit" class="btn btn-secondary btn-block my-4" >No tengo cuenta</a>
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
<script src="{{asset('js/instituciones/validarLogin.js')}}" type="text/javascript"></script>
<script src="{{asset('js/instituciones/validarLoginPass.js')}}" type="text/javascript"></script>
<script src="{{asset('js/instituciones/login.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#registrar").attr('disabled', true);
    });
</script>
@endsection