@extends('welcome')
@section('contenido')
<div class="content-wrapper" style="min-height: 1302.13px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edición de responsable</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/responsables')}}">Responsables</a></li>
                        <li class="breadcrumb-item active">Editar responsable</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title col-md-10">Modifica los datos como creas necesarios. Los campos con etiqueta * son obligatorios</h3>
                </div>
                <form role="form" id="formulario" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nombre">*Nombre(s)</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Director, Subdirector, etc." required value="{{$responsable->nombreResponsable}}">
                        </div>
                        <div class="form-group">
                            <label for="nombre">*Primer apellido</label>
                            <input type="text" class="form-control" id="apellido1" placeholder="Director, Subdirector, etc." required value="{{$responsable->apellido1Responsable}}">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Segundo apellido</label>
                            <input type="text" class="form-control" id="apellido2" placeholder="Director, Subdirector, etc." value="{{$responsable->apellido2Responsable}}">
                        </div>
                        <div class="form-group">
                            <label for="nombre">*C.U.R.P.</label>
                            <input type="text" class="form-control" id="curp" placeholder="Director, Subdirector, etc." required value="{{$responsable->curpResponsable}}">
                        </div>
                        <div class="form-group">
                            <label for="nombre">*Cargo</label>
                            <select class="form-control" name="cargo" id="cargo" required>
                                <option value="{{$responsable->cargo->id}}">{{$responsable->cargo->nombreCargo}}</option>
                                @foreach($cargos as $cargo)
                                    @if ($responsable->cargo->id!=$cargo->id)
                                        <option value="{{$cargo->id}}">{{$cargo->nombreCargo}}</option>    
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Abreviatura de título</label>
                            <input type="text" class="form-control" id="titulo" placeholder="Director, Subdirector, etc." value="{{$responsable->tituloResponsable}}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block" id="registrar"><b>Guardar cambios</b></button>
                    </div>
                    <input type="hidden" name="token" id="token" value="{{csrf_token()}}">
                    <input type="hidden" name="id" id="id" value="{{$responsable->id}}">
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/sweetAlert.js')}}"></script>
<script src="{{asset('js/jquery-3.6.js')}}" type="text/javascript"></script>
<script src="{{asset('js/responsables/actualizar.js')}}" type="text/javascript"></script>
<script src="{{asset('js/responsables/validarCurp.js')}}" type="text/javascript"></script>
<script src="{{asset('js/responsables/edicion.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#registrar").attr('disabled', true);
    });
</script>
@endsection