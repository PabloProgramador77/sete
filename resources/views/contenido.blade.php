@extends('welcome')
@section('contenido')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Bienvenido</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Inicio</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row p-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title col-md-10">SETE v2.0.0</h3>
                        </div>
                        <div class="card-body">
                            <p class="fs-4 fw-normal">La v2.0.0. mejora el uso y funcionalidad de la primera versión. Además, de contar con 
                                adaptabilidad para dispositivos moviles y tabletas. Podrán seguir disfrutando de la <u>gestión de egresados, grupos, 
                                responsables de firma, archivos XML</u>, entre otras funciones más integradas a esta nueva revisión.
                            </p>
                            <p class="fs-4 fw-normal">Sin más, disfruta de esta nueva versión. Aclarando que no tiene costo adicional al ya estipulado 
                                en la versión 1.0.0. Si no te has registrado aún, que esperas para hacerlo, es gratis y puedes disponer de una periodo 
                                de prueba.
                            </p>
                            <p class="fs-4 fw-normal">PD: se estan trabajando en mejoras de funcionamiento y mecanicas de uso para la plataforma. 
                                Proximamente.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection