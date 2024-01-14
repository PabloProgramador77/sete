@extends('welcome')
@section('contenido')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-5">
                    <h1 class="m-0">Expediciones</h1>
                </div>
                <div class="col-sm-5">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="/">Inicio</a>
                        </li>
                        <li class="breadcrumb-item active">Expediciones</li>
                    </ol>
                </div>
                <div class="col-sm-2">
                    <a href="{{url('/expediciones/nuevo')}}" role="button" class="btn btn-primary btn-sm" >
                        Nueva expedición
                    </a>
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
                        <th scope="col">Alumno</th>
                        <th scope="col">Fecha de expedición</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody id="contenedorexpedicion">
                    @if (count($expediciones)>0)
                        @foreach ($expediciones as $expedicion)
                            <tr>
                                <td>{{$expedicion->id}}</td>
                                <td>{{$expedicion->alumno->apellido1Alumno}} {{$expedicion->alumno->apellido2Alumno}} {{$expedicion->alumno->nombreAlumno}}</td>
                                <td>{{$expedicion->updated_at}}</td>
                                <td>
                                    <a href="{{url('/')}}/expediciones/editar/{{$expedicion->id}}" class="btn btn-primary" type="button" title="Editar expedicion">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </a>
                                    <a href="{{url('/')}}/expediciones/eliminar/{{$expedicion->id}}" type="button" class="btn btn-danger" title="Eliminar expedicion">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </a>
                                    <a href="{{url('/')}}/expediciones/archivo/{{$expedicion->id}}" type="button" class="btn btn-success" title="Crear archivo XML">
                                        <i class="fas fa-file-code"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td scope="row">Sin expediciones registradas.</td>
                        </tr>
                    @endif
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection