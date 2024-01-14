@extends('welcome')
@section('contenido')
<div class="content-wrapper" style="min-height: 1302.13px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Editar carrera(s)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/carreras')}}">Planes de estudio</a></li>
                        <li class="breadcrumb-item active">Editar carrera</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title col-md-10">Edita los datos como creas necesario. Los campos con etiqueta * son obligatorios</h3>
                </div>
                <form role="form" id="formulario" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nombre">*Nombre(s)</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Director, Subdirector, etc." required value="{{$carrera->nombreCarrera}}">
                        </div>
                        <div class="form-group">
                            <label for="rvoe">*RVOE</label>
                            <input type="text" class="form-control" id="rvoe" placeholder="Director, Subdirector, etc." required value="{{$carrera->rvoeCarrera}}">
                        </div>
                        <div class="form-group">
                            <label for="clave">*Clave</label>
                            <input type="text" class="form-control" id="clave" placeholder="Director, Subdirector, etc." required value="{{$carrera->claveCarrera}}">
                        </div>
                        <div class="form-group">
                            <label for="autoridad">*Autoridad que reconoce el RVOE</label>
                            <select class="form-control" name="autoridad" id="autoridad" required>
                                <option value="{{$carrera->autoridad->id}}">{{$carrera->autoridad->nombreAutoridad}}</option>
                                @foreach($autoridades as $autoridad)
                                    @if($autoridad->id!=$carrera->autoridad->id)
                                        <option value="{{$autoridad->id}}">{{$autoridad->nombreAutoridad}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block" id="registrar"><b>Guardar cambios</b></button>
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
<script src="{{asset('js/carreras/actualizar.js')}}" type="text/javascript"></script>
<script src="{{asset('js/carreras/validarRvoe.js')}}" type="text/javascript"></script>
<script src="{{asset('js/carreras/validarClave.js')}}" type="text/javascript"></script>
<script src="{{asset('js/carreras/edicion.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#registrar").attr('disabled', true);
    });
</script>
@endsection