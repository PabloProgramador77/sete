@extends('welcome')
@section('contenido')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Registro de usuarios</h1>
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
                            <h3 class="card-title col-md-10">Captura los datos solicitado. Los campos con <b>*</b> son obligatorios.</h3>
                        </div>
                        <div class="card-body">
                            <form role="form" class="row form-group" novalidate>
                                @csrf
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label for="nombre">*Nombre</label>
                                        <input type="text" class="form-control" id="nombre" required>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="categoria">*Categoria</label>
                                        <select name="categoria" id="categoria" required class="form-control">
                                            <option value="default">--Elige una entidad federativa--</option>
                                            <option value="Admin">Administrativo</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="telefono">*Teléfono</label>
                                        <input type="text" class="form-control" id="telefono" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label for="email">*Correo electrónico</label>
                                        <input type="email" class="form-control" id="email" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="pass">*Contraseña</label>
                                        <input type="password" class="form-control" id="pass" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="passConf">*Confirmar contraseña</label>
                                        <input type="password" class="form-control" id="passConf" required>
                                    </div>
                                </div>
                                <div class="col-6 m-auto">
                                    <div class="col-12 m-auto">
                                        <button type="submit" class="btn btn-primary btn-block my-1" id="registrar">Registrar</button>
                                    </div>
                                    <div class="col-12 m-auto">
                                        <a href="{{url('/admin')}}" role="submit" class="btn btn-secondary btn-block my-1" >Ya tengo cuenta</a>
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
<script src="{{asset('js/usuarios/registrar.js')}}" type="text/javascript"></script>
<script src="{{asset('js/usuarios/validarEmail.js')}}" type="text/javascript"></script>
<script src="{{asset('js/usuarios/validarPass.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        $("#registrar").attr('disabled', true);
    });
</script>
@endsection