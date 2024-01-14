@extends('welcome')
@section('contenido')
<div class="content-wrapper" style="min-height: 1302.13px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Registro de alumno(s)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/alumnos')}}">Alumnos egresados</a></li>
                        <li class="breadcrumb-item active">Nuevo alumno</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title col-md-10">Campos con etiqueta * son obligatorios</h3>
                </div>
                <form role="form" id="formulario" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nombre">*Nombre(s)</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Director, Subdirector, etc." required>
                        </div>
                        <div class="form-group">
                            <label for="rvoe">*Primer Apellido</label>
                            <input type="text" class="form-control" id="apellido1" placeholder="Director, Subdirector, etc." required>
                        </div>
                        <div class="form-group">
                            <label for="clave">Segundo Apellido</label>
                            <input type="text" class="form-control" id="apellido2" placeholder="Director, Subdirector, etc." >
                        </div>
                        <div class="form-group">
                            <label for="rvoe">*CURP</label>
                            <input type="text" class="form-control" id="curp" placeholder="Director, Subdirector, etc." required>
                        </div>
                        <div class="form-group">
                            <label for="rvoe">*Correo eletrónico</label>
                            <input type="text" class="form-control" id="email" placeholder="Director, Subdirector, etc." required>
                        </div>
                        <div class="form-group">
                            <label for="autoridad">*Plan de estudios</label>
                            <select class="form-control" name="carrera" id="carrera" required>
                                @foreach($carreras as $carrera)
                                    <option value="{{$carrera->id}}">{{$carrera->nombreCarrera}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="rvoe">*Fecha de inicio</label>
                            <input type="date" class="form-control" id="inicio" required>
                        </div>
                        <div class="form-group">
                            <label for="rvoe">*Fecha de termino</label>
                            <input type="date" class="form-control" id="final" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block" id="registrar"><b>Registrar</b></button>
                    </div>
                    <input type="hidden" name="token" id="token" value="{{csrf_token()}}">
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/sweetAlert.js')}}"></script>
<script src="{{asset('js/jquery-3.6.js')}}" type="text/javascript"></script>
<script src="{{asset('js/alumnos/registrar.js')}}" type="text/javascript"></script>
<script src="{{asset('js/alumnos/validarCurp.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#registrar").attr('disabled', true);
    });
</script>
@endsection