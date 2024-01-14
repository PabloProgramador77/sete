<?php

namespace App\Http\Controllers;

use App\Models\Expedicion;
use App\Models\Titulacion;
use App\Models\EntidadFederativa;
use App\Models\Fundamento;
use App\Models\Alumno;
use App\Models\Institucion;
use Illuminate\Http\Request;

class ExpedicionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session('idIpes')){

            $expediciones=array();

            $expediciones=Expedicion::where('idIpes', '=', session()->get('idIpes'))->get();

            return view('expediciones.index', ['expediciones'=>$expediciones]);

        }else{

            session()->forget('idIpes');
            session()->forget('nombreIpes');

            return view('institucion.login');

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alumnos=array();
        $fundamentos=array();
        $titulaciones=array();
        $entidades=array();

        if(session()->get('idIpes')){

            $alumnos=Alumno::where('idIpes', '=', session()->get('idIpes'))->get();
            $fundamentos=Fundamento::all();
            $titulaciones=Titulacion::all();
            $entidades=EntidadFederativa::all();

            return view('expediciones.nuevo', ['alumnos'=>$alumnos, 'fundamentos'=>$fundamentos, 'titulaciones'=>$titulaciones, 'entidades'=>$entidades]);

        }else{

            session()->forget('idIpes');
            session()->forget('nombreIpes');

            return view('institucion.login');

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $expedicion=array();
        $datos=array();

        try {
            
            $request->validate=[
                'alumno'=>'required',
                'servicio'=>'required',
                'fundamento'=>'required',
                'titulacion'=>'required',
                'entidad'=>'required'
            ];

            $expedicion=new Expedicion;
            $expedicion->servicioSocial=$request->servicio;
            $expedicion->idTitulacion=$request->titulacion;
            $expedicion->fechaExamen=$request->examen;
            $expedicion->fechaExencion=$request->exencion;
            $expedicion->idFundamento=$request->fundamento;
            $expedicion->idEntidad=$request->entidad;
            $expedicion->idAlumno=$request->alumno;
            $expedicion->idIpes=session()->get('idIpes');
            $expedicion->save();

            if($expedicion->id){

                $datos['exito']=true;
                $datos['mensaje']='Expedición exitosa.';

            }else{

                $datos['exito']=false;
                $datos['mensaje']='Expedición incompleta. Intenta de nuevo.';

            }

        } catch (\Throwable $th) {
            
            $datos['exito']=false;
            $datos['mensaje']=$th->getMessage();

        }

        return response()->json($datos);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expedicion  $expedicion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expedicion=array();

        if(session()->get('idIpes')){

            $expedicion=Expedicion::find($id);

            return view('expediciones.eliminar', ['expedicion'=>$expedicion]);

        }else{

            session()->forget('idIpes');
            session()->forget('nombreIpes');

            return view('institucion.login');

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expedicion  $expedicion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expedicion=array();
        $alumnos=array();
        $fundamentos=array();
        $titulaciones=array();
        $entidades=array();

        if(session()->get('idIpes')){

            $expedicion=Expedicion::find($id);
            $alumnos=Alumno::where('idIpes', '=', session()->get('idIpes'))->get();
            $fundamentos=Fundamento::all();
            $titulaciones=Titulacion::all();
            $entidades=EntidadFederativa::all();
            
            return view('expediciones.editar', ['alumnos'=>$alumnos, 'fundamentos'=>$fundamentos, 'titulaciones'=>$titulaciones, 'entidades'=>$entidades, 'expedicion'=>$expedicion]);

        }else{

            session()->forget('idIpes');
            session()->forget('nombreIpes');

            return view('institucion.login');

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expedicion  $expedicion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $expedicion=array();
        $datos=array();

        try {
            
            $request->validate=[
                'alumno'=>'required',
                'servicio'=>'required',
                'fundamento'=>'required',
                'titulacion'=>'required',
                'entidad'=>'required',
                'id'=>'required'
            ];

            $expedicion=Expedicion::find($request->id);

            if(!$expedicion){

                $datos['exito']=false;
                $datos['mensaje']='Expedición no encontrada. Intenta de nuevo.';

            }else{

                $expedicion->servicioSocial=$request->servicio;
                $expedicion->idTitulacion=$request->titulacion;
                $expedicion->fechaExamen=$request->examen;
                $expedicion->fechaExencion=$request->exencion;
                $expedicion->idFundamento=$request->fundamento;
                $expedicion->idEntidad=$request->entidad;
                $expedicion->idAlumno=$request->alumno;
                $expedicion->idIpes=session()->get('idIpes');
                $expedicion->save();

                if($expedicion->id){

                    $datos['exito']=true;
                    $datos['mensaje']='Expedición actualizada.';

                }else{

                    $datos['exito']=false;
                    $datos['mensaje']='Actualización no completada. Intenta de nuevo.';

                }

            }

        } catch (\Throwable $th) {
            
            $datos['exito']=false;
            $datos['mensaje']=$th->getMessage();

        }

        return response()->json($datos);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expedicion  $expedicion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $datos=array();
        $expedicion=array();

        try {
            
            $request->validate=[
                'id'=>'required'
            ];

            $expedicion=Expedicion::find($request->id);

            if(!$expedicion){

                $datos['exito']=false;
                $datos['mensaje']='Expedición no encontrada. Intenta de nuevo.';

            }else{

                $expedicion->delete();

                $datos['exito']=true;
                $datos['mensaje']='Expedición eliminada. Espera un momento por favor.';

            }

        } catch (\Throwable $th) {

            $datos['exito']=false;
            $datos['mensaje']=$th->getMessage();

        }

        return response()->json($datos);
    }

    /**
     * Búsqueda y validación de alumno
     * @param Request
     * @return json
     */
    public function alumno(Request $request){
        $expedicion=array();
        $datos=array();

        try {
            
            $request->validate=[
                'alumno'=>'required'
            ];

            $expedicion=Expedicion::where('idAlumno', '=', $request->alumno)
            ->where('idIpes', '=', session()->get('idIpes'))->first();

            if(!$expedicion){

                $datos['exito']=false;
                $datos['mensaje']='Alumno permitido para expedición.';

            }else{

                if($expedicion->idAlumno==$request->alumno){

                    $datos['exito']=true;
                    $datos['mensaje']='Alumno ya expedido. Intenta con otro.';

                }else{

                    $datos['exito']=false;
                    $datos['mensaje']='Alumno permitido para expedición.';

                }

            }

        } catch (\Throwable $th) {
            
            $datos['exito']=true;
            $datos['mensaje']=$th->getMessage();

        }

        return response()->json($datos);
    }
}
