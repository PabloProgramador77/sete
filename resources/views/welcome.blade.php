<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SETE</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <script src="https://kit.fontawesome.com/00b567f7fc.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{asset('dist/css/adminlte.css')}}">
        <meta name="csrf-token" content="{{csrf_token()}}">
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <!--<li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>-->
                    <li class="nav-item d-none d-sm-inline-block">
                        @if (session()->get('idUsuario'))
                            <a href="{{url('/usuario/logout')}}" class="nav-link">    
                        @else(session()->get('idIpes'))
                            <a href="{{url('/institucion/logout')}}" class="nav-link">
                        @endif
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Cerrar sesión
                        </a>
                    </li>
                </ul>
            </nav>
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="index3.html" class="brand-link">
                    <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">SETE</span>
                </a>
                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <!--<div class="image">
                            <img src="" class="img-circle elevation-2" alt="User Image">
                        </div>-->
                        @if(session()->get('nombreUsuario'))
                            <div class="info">
                                <a href="#" class="d-block">{{session()->get('nombreUsuario')}}</a>
                            </div>
                        @endif
                        @if(session()->get('nombreIpes'))
                            <div class="info">
                                <a href="#" class="d-block">{{session()->get('nombreIpes')}}</a>
                            </div>
                        @else
                            <div class="info">
                                <a href="#" class="d-block">Versión 2.0.0</a>
                            </div>
                        @endif
                    </div>
                    @if (session()->get('idUsuario') || session()->get('idIpes'))
                        <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                <li class="nav-item">
                                    <a href="/perfil" class="nav-link">
                                        <i class="fas fa-school"></i>
                                        <p>Perfil</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/responsables" class="nav-link">
                                        <i class="fas fa-signature"></i>
                                        <p>Responsables</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/alumnos" class="nav-link">
                                        <i class="fas fa-user-graduate"></i>
                                        <p>Alumnos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/carreras" class="nav-link">
                                        <i class="fas fa-book"></i>
                                        <p>Planes de estudio</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/expediciones" class="nav-link">
                                        <i class="fas fa-plus"></i>
                                        <p>Expediciones</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/archivos" class="nav-link">
                                        <i class="fas fa-file-code"></i>
                                        <p>Archivos XML</p>
                                    </a>
                                </li>
                                @if (session()->get('categoriaUsuario'))
                                    <li class="nav-item">
                                        <a href="/ipes" class="nav-link">
                                            <i class="fas fa-chalkboard-teacher"></i>
                                            <p>IPES</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/usuarios" class="nav-link">
                                            <i class="fas fa-user-cog"></i>
                                            <p>Usuarios</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/configuracion" class="nav-link">
                                            <i class="fas fa-cogs"></i>
                                            Configuración
                                        </a>
                                    </li>    
                                @endif
                            </ul>
                        </nav>
                    @endif
                </div>
            </aside>
            @yield('contenido')
            <footer class="main-footer">
                <strong>Copyright &copy; 2018 - 2022 <a href="#">PabloProgramador</a>.</strong>
                Todos los derechos reservados.
                <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 2.0.0
                </div>
            </footer>
        </div>
        <!--<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>-->
        <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('dist/js/adminlte.js')}}"></script>
    </body>
</html>
