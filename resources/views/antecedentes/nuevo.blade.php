@extends('welcome')
@section('contenido')
<div class="content-wrapper" style="min-height: 1302.13px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Registro de antecedente</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/alumnos')}}">Antecedentes egresados</a></li>
                        <li class="breadcrumb-item active">Antecedente de alumno</li>
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
                            <label for="nombre">*Alumno egresado</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Director, Subdirector, etc." readonly="true" value="{{$alumno->apellido1Alumno}} {{$alumno->apellido2Alumno}} {{$alumno->nombreAlumno}}">
                        </div>
                        <div class="form-group">
                            <label for="rvoe">*Institución antecedente</label>
                            @if (!$antecedente)
                                <input type="text" class="form-control" id="institucion" placeholder="Director, Subdirector, etc." required >    
                            @else
                                <input type="text" class="form-control" id="institucion" placeholder="Director, Subdirector, etc." required value="{{$antecedente->nombreAntecedente}}">
                            @endif
                            
                        </div>
                        <div class="form-group">
                            <label for="clave">Cedula obtenida</label>
                            @if (!$antecedente)
                                <input type="text" class="form-control" id="cedula" placeholder="Director, Subdirector, etc.">
                            @else
                                <input type="text" class="form-control" id="cedula" placeholder="Director, Subdirector, etc." value="{{$antecedente->cedulaAntecedente}}">
                            @endif
                            
                        </div>
                        <div class="form-group">
                            <label for="rvoe">*Fecha de inicio</label>
                            @if (!$antecedente)
                                <input type="date" class="form-control" id="inicio" required >
                            @else
                                <input type="date" class="form-control" id="inicio" required value="{{$antecedente->fechaInicioAntecedente}}">    
                            @endif
                            
                        </div>
                        <div class="form-group">
                            <label for="rvoe">*Fecha de termino</label>
                            @if (!$antecedente)
                                <input type="date" class="form-control" id="final" required >
                            @else
                                <input type="date" class="form-control" id="final" required value="{{$antecedente->fechaFinalAntecedente}}">    
                            @endif
                            
                        </div>
                        <div class="form-group">
                            <label for="autoridad">*Nivel de estudios</label>
                            <select class="form-control" name="estudio" id="estudio" required>
                                @if ($antecedente)
                                    <option value="{{$antecedente->estudio->id}}">{{$antecedente->estudio->nombreEstudio}}</option>
                                    @foreach($estudios as $estudio)
                                        @if ($estudio->id!=$antecedente->estudio->id)
                                            <option value="{{$estudio->id}}">{{$estudio->nombreEstudio}}</option>    
                                        @endif
                                    @endforeach
                                @else
                                    @foreach($estudios as $estudio)
                                        <option value="{{$estudio->id}}">{{$estudio->nombreEstudio}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="autoridad">*Entidad federativa</label>
                            <select class="form-control" name="entidad" id="entidad" required>
                                @if ($antecedente)
                                    <option value="{{$antecedente->entidad->id}}">{{$antecedente->entidad->nombreEntidad}}</option>
                                    @foreach($entidades as $entidad)
                                        @if ($antecedente->entidad->id!=$antecedente->entidad->id)
                                            <option value="{{$entidad->id}}">{{$entidad->nombreEntidad}}</option>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach($entidades as $entidad)
                                        <option value="{{$entidad->id}}">{{$entidad->nombreEntidad}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block" id="registrar"><b>Registrar</b></button>
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
@if (!$antecedente)
    <script src="{{asset('js/antecedentes/registrar.js')}}" type="text/javascript"></script>    
@else
    <script src="{{asset('js/antecedentes/actualizar.js')}}" type="text/javascript"></script>
@endif
@endsection