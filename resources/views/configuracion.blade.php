@extends('welcome')
@section('contenido')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Configuración de SETE</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="/">Inicio</a>
                        </li>
                        <li class="breadcrumb-item active">Configuración</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row shadow rounded bg-white">
                <p class="p-2 m-auto fs-4 fw-semibold text-left">Elige la opción a configurar en el sistema</p>
            </div>
            <div class="row my-3">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>32</h3>
                            <p>Entidades Federativas</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-city"></i>
                        </div>
                        <a href="{{url('/entidades')}}" class="small-box-footer">
                            Configurar
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>6</h3>
                            <p>Niveles de Estudios</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-book"></i>
                        </div>
                        <a href="{{url('/estudios')}}" class="small-box-footer">
                            Configurar
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>    
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>9</h3>
                            <p>Autoridad RVOE</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <a href="{{url('/autoridades')}}" class="small-box-footer">
                            Configurar
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>    
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>9</h3>
                            <p>Cargos de responsables</p>
                        </div>
                        <div class="icon">
                                <i class="fas fa-signature"></i>
                        </div>
                        <a href="{{url('/cargos')}}" class="small-box-footer">
                            Configurar
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>    
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>9</h3>
                            <p>Fundamentos de Servicio Social</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <a href="{{url('/fundamentos')}}" class="small-box-footer">
                            Configurar
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>    
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>9</h3>
                            <p>Modalidades de Titulación</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <a href="{{url('/titulaciones')}}" class="small-box-footer">
                            Configurar
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection