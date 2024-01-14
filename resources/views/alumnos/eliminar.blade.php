@extends('welcome')
@section('contenido')
<div class="content-wrapper" style="min-height: 1302.13px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Eliminación de alumno</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/alumnos')}}">Alumnos egresados</a></li>
                        <li class="breadcrumb-item active">Eliminar alumno</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title col-md-10">Comprueba que sea el alumno correcto a eliminar. Todos los datos relacionados con el mismo también serán eliminados.</h3>
                </div>
                <form role="form" id="formulario" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nombre">*Nombre(s)</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Director, Subdirector, etc." readonly="true" value="{{$alumno->nombreAlumno}}">
                        </div>
                        <div class="form-group">
                            <label for="rvoe">*Primer Apellido</label>
                            <input type="text" class="form-control" id="apellido1" placeholder="Director, Subdirector, etc." readonly="true" value="{{$alumno->apellido1Alumno}}">
                        </div>
                        <div class="form-group">
                            <label for="clave">Segundo Apellido</label>
                            <input type="text" class="form-control" id="apellido2" placeholder="Director, Subdirector, etc." readonly="true" value="{{$alumno->apellido2Alumno}}" >
                        </div>
                        <div class="form-group">
                            <label for="rvoe">*CURP</label>
                            <input type="text" class="form-control" id="curp" placeholder="Director, Subdirector, etc." readonly="true" value="{{$alumno->curpAlumno}}">
                        </div>
                        <div class="form-group">
                            <label for="rvoe">*Correo eletrónico</label>
                            <input type="text" class="form-control" id="email" placeholder="Director, Subdirector, etc." readonly="true" value="{{$alumno->emailAlumno}}">
                        </div>
                        <div class="form-group">
                            <label for="autoridad">*Plan de estudios</label>
                            <select class="form-control" name="carrera" id="carrera" readonly="true">
                                <option value="{{$alumno->carrera->id}}">{{$alumno->carrera->nombreCarrera}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block" id="registrar"><b>Eliminar</b></button>
                    </div>
                    <input type="hidden" name="token" id="token" value="{{csrf_token()}}">
                    <input type="hidden" name="id" id="id" value="{{$alumno->id}}">
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/sweetAlert.js')}}"></script>
<script src="{{asset('js/jquery-3.6.js')}}" type="text/javascript"></script>
<script src="{{asset('js/alumnos/eliminar.js')}}" type="text/javascript"></script>
@endsection