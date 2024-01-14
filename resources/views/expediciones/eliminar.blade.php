@extends('welcome')
@section('contenido')
<div class="content-wrapper" style="min-height: 1302.13px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Eliminación de expedición</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/expediciones')}}">Expediciones</a></li>
                        <li class="breadcrumb-item active">Eliminar expedición</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title col-md-10">Verifica que sea la expedición correcta a eliminar. Los datos no podrán ser recuperados de ninguna forma.</h3>
                </div>
                <form role="form" id="formulario" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="alumno">*Alumno</label>
                            <select class="form-control" name="alumno" id="alumno" readonly="true">
                                <option value="{{$expedicion->alumno->id}}">{{$expedicion->alumno->apellido1Alumno}} {{$expedicion->alumno->apellido1Alumno}} {{$expedicion->alumno->nombreAlumno}}</option>
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="examen">*Fecha de examen</label>
                            <input type="date" class="form-control" id="examen" readonly="true" value="{{$expedicion->fechaExamen}}">
                        </div>
                        <div class="form-group">
                            <label for="exencion">Fecha de exención</label>
                            <input type="date" class="form-control" id="exencion" value="{{$expedicion->fechaExencion}}" readonly="true">
                        </div>
                        <div class="form-group">
                            <label for="servicio">*¿Cumplio el servicio social?</label>
                            <select class="form-control" name="servicio" id="servicio" readonly="true">
                                
                                @if ($expedicion->servicioSocial=='1')
                                    <option value="{{$expedicion->servicioSocial}}">Si</option>
                                @else
                                    <option value="{{$expedicion->servicioSocial}}">No</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fundamento">*Fundamento legal de cumplimiento</label>
                            <select class="form-control" name="fundamento" id="fundamento" readonly="true">
                                <option value="{{$expedicion->fundamento->id}}">{{$expedicion->fundamento->nombreFundamento}}</option>
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="titulacion">*Modalidad de titulación</label>
                            <select class="form-control" name="titulacion" id="titulacion" readonly="true">
                                <option value="{{$expedicion->titulacion->id}}">{{$expedicion->titulacion->nombreTitulacion}}</option>
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="entidad">*Entidad fedrativa</label>
                            <select class="form-control" name="entidad" id="entidad" readonly="true">
                                <option value="{{$expedicion->entidad->id}}">{{$expedicion->entidad->nombreEntidad}}</option>
                                
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block" id="registrar"><b>Eliminar</b></button>
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
<script src="{{asset('js/expediciones/eliminar.js')}}" type="text/javascript"></script>
@endsection