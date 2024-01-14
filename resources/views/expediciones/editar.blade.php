@extends('welcome')
@section('contenido')
<div class="content-wrapper" style="min-height: 1302.13px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edición de expedición</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/expediciones')}}">Expediciones</a></li>
                        <li class="breadcrumb-item active">Editar expedición</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title col-md-10">Modifica los datos como necesites. Los campos con etiqueta * son obligatorios</h3>
                </div>
                <form role="form" id="formulario" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="alumno">*Alumno</label>
                            <select class="form-control" name="alumno" id="alumno" required>
                                <option value="{{$expedicion->alumno->id}}">{{$expedicion->alumno->apellido1Alumno}} {{$expedicion->alumno->apellido1Alumno}} {{$expedicion->alumno->nombreAlumno}}</option>
                                @foreach($alumnos as $alumno)
                                    @if ($expedicion->alumno->id!=$alumno->id)
                                        <option value="{{$alumno->id}}">{{$alumno->apellido1Alumno}} {{$alumno->apellido1Alumno}} {{$alumno->nombreAlumno}}</option>
                                    @endif    
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="examen">*Fecha de examen</label>
                            <input type="date" class="form-control" id="examen" required value="{{$expedicion->fechaExamen}}">
                        </div>
                        <div class="form-group">
                            <label for="exencion">Fecha de exención</label>
                            <input type="date" class="form-control" id="exencion" value="{{$expedicion->fechaExencion}}">
                        </div>
                        <div class="form-group">
                            <label for="servicio">*¿Cumplio el servicio social?</label>
                            <select class="form-control" name="servicio" id="servicio" required>
                                
                                @if ($expedicion->servicioSocial=='1')
                                    <option value="{{$expedicion->servicioSocial}}">Si</option>
                                    <option value="0">No</option>
                                @else
                                    <option value="{{$expedicion->servicioSocial}}">No</option>
                                    <option value="1">Si</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fundamento">*Fundamento legal de cumplimiento</label>
                            <select class="form-control" name="fundamento" id="fundamento" required>
                                <option value="{{$expedicion->fundamento->id}}">{{$expedicion->fundamento->nombreFundamento}}</option>
                                @foreach($fundamentos as $fundamento)
                                    @if ($expedicion->fundamento->id!=$fundamento->id)
                                        <option value="{{$fundamento->id}}">{{$fundamento->nombreFundamento}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="titulacion">*Modalidad de titulación</label>
                            <select class="form-control" name="titulacion" id="titulacion" required>
                                <option value="{{$expedicion->titulacion->id}}">{{$expedicion->titulacion->nombreTitulacion}}</option>
                                @foreach($titulaciones as $titulacion)
                                    @if($expedicion->titulacion->id!=$titulacion->id)
                                        <option value="{{$titulacion->id}}">{{$titulacion->nombreTitulacion}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="entidad">*Entidad fedrativa</label>
                            <select class="form-control" name="entidad" id="entidad" required>
                                <option value="{{$expedicion->entidad->id}}">{{$expedicion->entidad->nombreEntidad}}</option>
                                @foreach($entidades as $entidad)
                                    @if($expedicion->entidad->id!=$entidad->id)
                                        <option value="{{$entidad->id}}">{{$entidad->nombreEntidad}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block" id="registrar"><b>Actualizar</b></button>
                    </div>
                    <input type="hidden" name="token" id="token" value="{{csrf_token()}}">
                    <input type="hidden" name="id" id="id" value="{{$expedicion->id}}">
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/sweetAlert.js')}}"></script>
<script src="{{asset('js/jquery-3.6.js')}}" type="text/javascript"></script>
<script src="{{asset('js/expediciones/actualizar.js')}}" type="text/javascript"></script>
<script src="{{asset('js/expediciones/verificarAlumno.js')}}" type="text/javascript"></script>
<script src="{{asset('js/expediciones/edicion.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#registrar").attr('disabled', true);
    });
</script>
@endsection