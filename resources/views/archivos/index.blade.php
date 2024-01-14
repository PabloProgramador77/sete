@extends('welcome')
@section('contenido')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-5">
                    <h1 class="m-0">Archivos XML</h1>
                </div>
                <div class="col-sm-5">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="/">Inicio</a>
                        </li>
                        <li class="breadcrumb-item active">Archivos XML</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre de archivo</th>
                        <th scope="col">Fecha de creación</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody id="contenedorarchivo">
                    @if (count($archivos)>0)
                        @foreach ($archivos as $archivo)
                            <tr>
                                <td>{{$archivo->id}}</td>
                                <td>{{$archivo->folioArchivo}}.xml</td>
                                <td>{{$archivo->updated_at}}</td>
                                <td>
                                    @if ($archivo->estatusArchivo=='Pagado')
                                        <a href="{{url('/')}}/archivos/descargar/{{$archivo->id}}" class="btn btn-primary" type="button" title="Editar archivo">
                                            <i class="fas fa-file-download"></i>
                                        </a>    
                                    @elseif($archivo->estatusArchivo=='Tramitado')
                                        <a href="{{url('/')}}/archivos/tramitado/{{$archivo->id}}" id="tramite" class="btn btn-secondary" type="button" title="Tramitando Título">
                                            <i class="fas fa-info"></i>
                                        </a>
                                    @else
                                        <a href="{{url('/')}}/archivos/pagar/{{$archivo->id}}" class="btn btn-primary" type="button" title="Editar archivo">
                                            <i class="fas fa-cart-plus"></i>
                                        </a>
                                        <a href="{{url('/')}}/archivos/tramitar/{{$archivo->id}}" class="btn btn-info" type="button" title="Tramitar Título Electrónico">
                                            <i class="fas fa-cart-plus"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td scope="row">Sin archivos XML registrados.</td>
                        </tr>
                    @endif
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/sweetAlert.js')}}"></script>
<script src="{{asset('js/jquery-3.6.js')}}" type="text/javascript"></script>
<script src="{{asset('js/archivos/tramite.js')}}" type="text/javascript"></script>
@endsection