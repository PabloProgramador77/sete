@extends('welcome')
@section('contenido')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Acceso administrativo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Acceso privado</li>
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
                            <h3 class="card-title col-md-10">Identificación de administrativo</h3>
                        </div>
                        <div class="card-body">
                            <p class="fs-4 fw-normal">Por favor, si no eres administrativo no intentes acceder. Este acceso esta monitoreado las 24 hrs.
                            </p>
                            <form action="" class="row form-group" novalidate>
                                @csrf
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label for="email">*Correo electrónico</label>
                                        <input type="email" class="form-control" id="email" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="pass">*Contraseña</label>
                                        <input type="password" class="form-control" id="pass" required>
                                    </div>
                                </div>
                                <div class="col-6 m-auto">
                                    <div class="col-8 m-auto">
                                        <button type="submit" class="btn btn-primary btn-block my-4" id="registrar">Entrar</button>
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
<script src="{{asset('js/jquery-3.6.js')}}" type="text/javascript"></script>
<script src="{{asset('js/sweetAlert.js')}}" type="text/javascript"></script>
<script src="{{asset('js/usuarios/validarLogin.js')}}" type="text/javascript"></script>
<script src="{{asset('js/usuarios/login.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        $("#registrar").attr('disabled', true);
    });
</script>
@endsection