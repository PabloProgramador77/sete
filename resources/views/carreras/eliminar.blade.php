@extends('welcome')
@section('contenido')
<div class="content-wrapper" style="min-height: 1302.13px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Eliminar carrera(s)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/carreras')}}">Planes de estudio</a></li>
                        <li class="breadcrumb-item active">Eliminar carrera</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title col-md-10">Verifica que sea la carrera correcta. Si es así presiona ELIMINAR.</h3>
                </div>
                <form role="form" id="formulario" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nombre">*Nombre(s)</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Director, Subdirector, etc." readonly="true" value="{{$carrera->nombreCarrera}}">
                        </div>
                        <div class="form-group">
                            <label for="rvoe">*RVOE</label>
                            <input type="text" class="form-control" id="rvoe" placeholder="Director, Subdirector, etc." readonly="true" value="{{$carrera->rvoeCarrera}}">
                        </div>
                        <div class="form-group">
                            <label for="clave">*Clave</label>
                            <input type="text" class="form-control" id="clave" placeholder="Director, Subdirector, etc." readonly="true" value="{{$carrera->claveCarrera}}">
                        </div>
                        <div class="form-group">
                            <label for="autoridad">*Autoridad que reconoce el RVOE</label>
                            <select class="form-control" name="autoridad" id="autoridad" readonly="true">
                                <option value="{{$carrera->autoridad->id}}">{{$carrera->autoridad->nombreAutoridad}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block" id="registrar"><b>Eliminar</b></button>
                    </div>
                    <input type="hidden" name="token" id="token" value="{{csrf_token()}}">
                    <input type="hidden" name="id" id="id" value="{{$carrera->id}}">
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/sweetAlert.js')}}"></script>
<script src="{{asset('js/jquery-3.6.js')}}" type="text/javascript"></script>
<script src="{{asset('js/carreras/eliminar.js')}}" type="text/javascript"></script>

@endsection