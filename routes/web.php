<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EntidadFederativaController;
use App\Http\Controllers\EstudioController;
use App\Http\Controllers\AutoridadController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\FundamentoController;
use App\Http\Controllers\TitulacionController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\AlumnoController;

Route::get('/admin', function(){
    return view('admin');
});

Route::get('/configuracion', function(){
    return view('configuracion');
});

Route::get('/index', function(){
    return view('contenido');
});

/*Rutas de IPES */
Route::get('/', 'App\Http\Controllers\InstitucionController@index');
Route::get('/registro', 'App\Http\Controllers\InstitucionController@registro');
Route::get('/login', 'App\Http\Controllers\InstitucionController@login');
Route::post('/institucion/nombre', 'App\Http\Controllers\InstitucionController@validarNombre');
Route::post('/institucion/clave', 'App\Http\Controllers\InstitucionController@validarClave');
Route::post('/institucion/email', 'App\Http\Controllers\InstitucionController@validarEmail');
Route::post('/institucion/registrar', 'App\Http\Controllers\InstitucionController@store');
Route::post('/institucion/emailLogin', 'App\Http\Controllers\InstitucionController@validarLogin');
Route::post('/institucion/passLogin', 'App\Http\Controllers\InstitucionController@validarPass');
Route::get('/institucion/entrar', 'App\Http\Controllers\InstitucionController@index');
Route::get('/institucion/logout', 'App\Http\Controllers\InstitucionController@logout');
Route::get('/perfil', 'App\Http\Controllers\InstitucionController@edit');
Route::post('/institucion/actualizar', 'App\Http\Controllers\InstitucionController@update');
/*Final de rutas de IPES */

/**Rutas de usuarios administrativos */
Route::get('/usuario/registro', 'App\Http\Controllers\UsuarioController@create');
Route::post('/usuario/registrar', 'App\Http\Controllers\UsuarioController@store');
Route::post('/usuario/email', 'App\Http\Controllers\UsuarioController@validarEmail');
Route::post('/usuario/validarLogin', 'App\Http\Controllers\UsuarioController@validarEmail');
Route::post('/usuario/login', 'App\Http\Controllers\UsuarioController@login');
Route::get('/usuario/logout', 'App\Http\Controllers\UsuarioController@logout');
/*Fin de rutas de usuarios */

/*Rutas de entidades federativas */
Route::get('/entidades', 'App\Http\Controllers\EntidadFederativaController@index');
Route::get('/entidades/nuevo', 'App\Http\Controllers\EntidadFederativaController@create');
Route::post('/entidades/validar', 'App\Http\Controllers\EntidadFederativaController@validar');
Route::post('/entidades/registrar', 'App\Http\Controllers\EntidadFederativaController@store');
Route::get('/entidades/editar/{id}', 'App\Http\Controllers\EntidadFederativaController@edit');
Route::post('/entidades/actualizar', 'App\Http\Controllers\EntidadFederativaController@update');
Route::get('/entidades/eliminar/{id}', 'App\Http\Controllers\EntidadFederativaController@show');
Route::post('/entidades/borrar', 'App\Http\Controllers\EntidadFederativaController@destroy');
/*Fin de rutas de entidades federativas */

/**Rutas de niveles de estudio */
Route::get('/estudios', 'App\Http\Controllers\EstudioController@index');
Route::get('/estudios/nuevo', 'App\Http\Controllers\EstudioController@create');
Route::post('/estudios/validar', 'App\Http\Controllers\EstudioController@validar');
Route::post('/estudios/registrar', 'App\Http\Controllers\EstudioController@store');
Route::get('/estudios/editar/{id}', 'App\Http\Controllers\EstudioController@edit');
Route::post('/estudios/actualizar', 'App\Http\Controllers\EstudioController@update');
Route::get('/estudios/eliminar/{id}', 'App\Http\Controllers\EstudioController@show');
Route::post('/estudios/borrar', 'App\Http\Controllers\EstudioController@destroy');
/**Fin de rutas de niveles de estudio */

/**Rutas de autoridades RVOE */
Route::get('/autoridades', 'App\Http\Controllers\AutoridadController@index');
Route::get('/autoridades/nuevo', 'App\Http\Controllers\AutoridadController@create');
Route::post('/autoridades/validar', 'App\Http\Controllers\AutoridadController@validar');
Route::post('/autoridades/registrar', 'App\Http\Controllers\AutoridadController@store');
Route::get('/autoridades/editar/{id}', 'App\Http\Controllers\AutoridadController@edit');
Route::post('/autoridades/actualizar', 'App\Http\Controllers\AutoridadController@update');
Route::get('/autoridades/eliminar/{id}', 'App\Http\Controllers\AutoridadController@show');
Route::post('/autoridades/borrar', 'App\Http\Controllers\AutoridadController@destroy');
/**Fin de autoridades RVOE */

/**Rutas de cargos de responsables */
Route::get('/cargos', 'App\Http\Controllers\CargoController@index');
Route::get('/cargo/nuevo', 'App\Http\Controllers\CargoController@create');
Route::post('/cargo/validar', 'App\Http\Controllers\CargoController@validar');
Route::post('/cargo/registrar', 'App\Http\Controllers\CargoController@store');
Route::get('/cargo/editar/{id}', 'App\Http\Controllers\CargoController@edit');
Route::post('/cargo/actualizar', 'App\Http\Controllers\CargoController@update');
Route::get('/cargo/eliminar/{id}', 'App\Http\Controllers\CargoController@show');
Route::post('/cargo/borrar', 'App\Http\Controllers\CargoController@destroy');
/**Fin de rutas de cargos de responsables */

/**Rutas de fundamentos de servicio social */
Route::get('/fundamentos', 'App\Http\Controllers\FundamentoController@index');
Route::get('/fundamento/nuevo', 'App\Http\Controllers\FundamentoController@create');
Route::post('/fundamento/validar', 'App\Http\Controllers\FundamentoController@validar');
Route::post('/fundamento/registrar', 'App\Http\Controllers\FundamentoController@store');
Route::get('/fundamento/editar/{id}', 'App\Http\Controllers\FundamentoController@edit');
Route::post('/fundamento/actualizar', 'App\Http\Controllers\FundamentoController@update');
Route::get('/fundamento/eliminar/{id}', 'App\Http\Controllers\FundamentoController@show');
Route::post('/fundamento/borrar', 'App\Http\Controllers\FundamentoController@destroy');
/**Fin de rutas de fundamentos */

/**Rutas de modalidad de titulacion */
Route::get('/titulaciones', 'App\Http\Controllers\TitulacionController@index');
Route::get('/titulacion/nuevo', 'App\Http\Controllers\TitulacionController@create');
Route::post('/titulacion/validar', 'App\Http\Controllers\TitulacionController@validar');
Route::post('/titulacion/registrar', 'App\Http\Controllers\TitulacionController@store');
Route::get('/titulacion/editar/{id}', 'App\Http\Controllers\TitulacionController@edit');
Route::post('/titulacion/actualizar', 'App\Http\Controllers\TitulacionController@update');
Route::get('/titulacion/eliminar/{id}', 'App\Http\Controllers\TitulacionController@show');
Route::post('/titulacion/borrar', 'App\Http\Controllers\TitulacionController@destroy');
/**Fin de rutas de titulacion */

/**Rutas de responsables */
Route::get('/responsables', 'App\Http\Controllers\ResponsableController@index');
Route::get('/responsables/nuevo', 'App\Http\Controllers\ResponsableController@create');
Route::post('/responsables/curp', 'App\Http\Controllers\ResponsableController@curp');
Route::post('/responsables/registrar', 'App\Http\Controllers\ResponsableController@store');
Route::get('/responsables/editar/{id}', 'App\Http\Controllers\ResponsableController@edit');
Route::post('/responsables/actualizar', 'App\Http\Controllers\ResponsableController@update');
Route::get('/responsables/eliminar/{id}', 'App\Http\Controllers\ResponsableController@show');
Route::post('/responsables/borrar', 'App\Http\Controllers\ResponsableController@destroy');
/**Fin de rutas de responsables */

/**Rutas de carreras */
Route::get('/carreras', 'App\Http\Controllers\CarreraController@index');
Route::get('/carreras/nuevo', 'App\Http\Controllers\CarreraController@create');
Route::post('/carreras/rvoe', 'App\Http\Controllers\CarreraController@rvoe');
Route::post('/carreras/clave', 'App\Http\Controllers\CarreraController@clave');
Route::post('/carreras/registrar', 'App\Http\Controllers\CarreraController@store');
Route::get('/carreras/editar/{id}', 'App\Http\Controllers\CarreraController@edit');
Route::post('/carreras/actualizar', 'App\Http\Controllers\CarreraController@update');
Route::get('/carreras/eliminar/{id}', 'App\Http\Controllers\CarreraController@show');
Route::post('/carreras/borrar', 'App\Http\Controllers\CarreraController@destroy');
/**Fin de rutas de carreras */

/**Rutas de alumnos */
Route::get('/alumnos', 'App\Http\Controllers\AlumnoController@index');
Route::get('/alumnos/nuevo', 'App\Http\Controllers\AlumnoController@create');
Route::post('/alumnos/curp', 'App\Http\Controllers\AlumnoController@curp');
Route::post('/alumnos/registrar', 'App\Http\Controllers\AlumnoController@store');
Route::get('/alumnos/editar/{id}', 'App\Http\Controllers\AlumnoController@edit');
Route::post('/alumnos/actualizar', 'App\Http\Controllers\AlumnoController@update');
Route::get('/alumnos/eliminar/{id}', 'App\Http\Controllers\AlumnoController@show');
Route::post('/alumnos/borrar', 'App\Http\Controllers\AlumnoController@destroy');
/**Fin de rutas de alumnos */

/**Rutas de antecedentes */
Route::get('/alumnos/antecedentes/{id}', 'App\Http\Controllers\AntecedenteController@create');
Route::post('/antecedentes/registrar', 'App\Http\Controllers\AntecedenteController@store');
Route::post('/antecedentes/actualizar', 'App\Http\Controllers\AntecedenteController@update');
/**Fin de rutas de antecedentes */

/**Rutas de expediciones */
Route::get('/expediciones', 'App\Http\Controllers\ExpedicionController@index');
Route::get('/expediciones/nuevo', 'App\Http\Controllers\ExpedicionController@create');
Route::post('/expediciones/registrar', 'App\Http\Controllers\ExpedicionController@store');
Route::post('/expediciones/alumno', 'App\Http\Controllers\ExpedicionController@alumno');
Route::get('/expediciones/editar/{id}', 'App\Http\Controllers\ExpedicionController@edit');
Route::post('/expediciones/actualizar', 'App\Http\Controllers\ExpedicionController@update');
Route::get('/expediciones/eliminar/{id}', 'App\Http\Controllers\ExpedicionController@show');
Route::post('/expediciones/borrar', 'App\Http\Controllers\ExpedicionController@destroy');
/**Fin de rutas de antecedentes */

/**Rutas de archivos XML */
Route::get('/expediciones/archivo/{id}', 'App\Http\Controllers\ArchivoController@create');
Route::post('/archivos/registrar', 'App\Http\Controllers\ArchivoController@store');
Route::post('/archivos/folio', 'App\Http\Controllers\ArchivoController@folio');
Route::get('/archivos', 'App\Http\Controllers\ArchivoController@index');
Route::post('/archivos/actualizar', 'App\Http\Controllers\ArchivoController@update');
Route::get('/archivos/pagar/{idArchivo}', 'App\Http\Controllers\ArchivoController@show');
Route::post('/archivos/pagar', 'App\Http\Controllers\ArchivoController@pagar');
Route::get('/archivos/tramitar/{idArchivo}', 'App\Http\Controllers\ArchivoController@edit');
/**Fin de rutas de archivos XML */

/**Rutas de archivos llaves */
Route::get('/responsables/llaves/{id}', 'App\Http\Controllers\LlaveController@create');
Route::post('/llaves/cer', 'App\Http\Controllers\LlaveController@cer');
Route::post('/llaves/key', 'App\Http\Controllers\LlaveController@key');
Route::post('/llaves/registrar', 'App\Http\Controllers\LlaveController@store');
Route::get('/llaves/editar/{id}', 'App\Http\Controllers\LlaveController@edit');
Route::post('/llaves/actualizarCer', 'App\Http\Controllers\LlaveController@actualizarCer');
Route::get('/llaves/privada/{id}', 'App\Http\Controllers\LlaveController@editPrivada');
Route::post('/llaves/actualizarKey', 'App\Http\Controllers\LlaveController@actualizarKey');
Route::get('/llaves/password/{id}', 'App\Http\Controllers\LlaveController@editPass');
Route::post('/llaves/actualizarPass', 'App\Http\Controllers\LlaveController@actualizarPass');
/**Fin de rutas de llaves */