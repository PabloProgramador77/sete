@extends('welcome')
@section('contenido')
<div class="content-wrapper" style="min-height: 1302.13px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Registro de expedición</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/expediciones')}}">Expediciones</a></li>
                        <li class="breadcrumb-item active">Nueva expedicion</li>
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
                            <label for="alumno">*Alumno</label>
                            <select class="form-control" name="alumno" id="alumno" required>
                                <option value="default">-- Elige el alumno a expedir --</option>
                                @foreach($alumnos as $alumno)
                                    <option value="{{$alumno->id}}">{{$alumno->apellido1Alumno}} {{$alumno->apellido1Alumno}} {{$alumno->nombreAlumno}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="examen">*Fecha de examen</label>
                            <input type="date" class="form-control" id="examen" required>
                        </div>
                        <div class="form-group">
                            <label for="exencion">Fecha de exención</label>
                            <input type="date" class="form-control" id="exencion" >
                        </div>
                        <div class="form-group">
                            <label for="servicio">*¿Cumplio el servicio social?</label>
                            <select class="form-control" name="servicio" id="servicio" required>
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fundamento">*Fundamento legal de cumplimiento</label>
                            <select class="form-control" name="fundamento" id="fundamento" required>
                                @foreach($fundamentos as $fundamento)
                                    <option value="{{$fundamento->id}}">{{$fundamento->nombreFundamento}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="titulacion">*Modalidad de titulación</label>
                            <select class="form-control" name="titulacion" id="titulacion" required>
                                @foreach($titulaciones as $titulacion)
                                    <option value="{{$titulacion->id}}">{{$titulacion->nombreTitulacion}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="entidad">*Entidad fedrativa</label>
                            <select class="form-control" name="entidad" id="entidad" required>
                                @foreach($entidades as $entidad)
                                    <option value="{{$entidad->id}}">{{$entidad->nombreEntidad}}</option>
                                @endforeach
                            </select>
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
<script src="{{asset('js/expediciones/registrar.js')}}" type="text/javascript"></script>
<script src="{{asset('js/expediciones/verificarAlumno.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#registrar").attr('disabled', true);
    });
</script>
@endsection