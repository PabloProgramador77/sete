<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use App\Models\Carrera;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session()->get('idIpes')){

            $alumnos=array();
            $alumnos=Alumno::where('idIpes', '=', session()->get('idIpes'))->get();

            return view('alumnos.index', ['alumnos'=>$alumnos]);

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
        if(session()->get('idIpes')){

            $carreras=array();
            $carreras=Carrera::where('idIpes', '=', session()->get('idIpes'))->get();

            return view('alumnos.nuevo', ['carreras'=>$carreras]);

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
        $alumno=array();
        $datos=array();

        try {
            
            $request->validate=[
                'nombre'=>'required',
                'apellido1'=>'required',
                'curp'=>'required',
                'email'=>'required',
                'carrera'=>'required',
                'inicio'=>'required',
                'final'=>'required'
            ];

            $alumno=new Alumno;
            $alumno->nombreAlumno=$request->nombre;
            $alumno->apellido1Alumno=$request->apellido1;
            $alumno->apellido2Alumno=$request->apellido2;
            $alumno->curpAlumno=$request->curp;
            $alumno->emailAlumno=$request->email;
            $alumno->idIpes=session()->get('idIpes');
            $alumno->idCarrera=$request->carrera;
            $alumno->fechaInicioCarrera=$request->inicio;
            $alumno->fechaFinalCarrera=$request->final;
            $alumno->save();

            if($alumno->id){

                $datos['exito']=true;
                $datos['mensaje']='Alumno registrado. Espera un momento.';

            }else{

                $datos['exito']=false;
                $datos['mensaje']='Registro incompleto. Intente de nuevo.';

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
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(session()->get('idIpes')){

            $alumno=Alumno::find($id);

            return view('alumnos.eliminar', ['alumno'=>$alumno]);

        }else{

            session()->forget('idIpes');
            session()->forget('nombreIpes');

            return view('institucion.login');

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(session()->get('idIpes')){

            $alumno=array();
            $carreras=array();

            $alumno=Alumno::find($id);
            $carreras=Carrera::where('idIpes', '=', session()->get('idIpes'))->get();

            return view('alumnos.editar', ['alumno'=>$alumno, 'carreras'=>$carreras]);

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
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $datos=array();
        $alumno=array();

        try {
            
            $request->validate=[
                'nombre'=>'required',
                'apellido1'=>'required',
                'curp'=>'required',
                'email'=>'required',
                'carrera'=>'required',
                'id'=>'required',
                'inicio'=>'required',
                'final'=>'required'
            ];

            $alumno=Alumno::find($request->id);

            if(!$alumno){

                $datos['exito']=false;
                $datos['mensaje']='Alumno no encontrado. Intenta de nuevo.';

            }else{

                $alumno->nombreAlumno=$request->nombre;
                $alumno->apellido1Alumno=$request->apellido1;
                $alumno->apellido2Alumno=$request->apellido2;
                $alumno->curpAlumno=$request->curp;
                $alumno->emailAlumno=$request->email;
                $alumno->idCarrera=$request->carrera;
                $alumno->fechaInicioCarrera=$request->inicio;
                $alumno->fechaFinalCarrera=$request->final;
                $alumno->save();

                if($alumno->id){

                    $datos['exito']=true;
                    $datos['mensaje']='Alumno actualizado.';

                }else{

                    $datos['exito']=false;
                    $datos['mensaje']='Actualización incompleta. Intenta de nuevo.';

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
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $datos=array();
        $alumno=array();

        try {
            
            $request->validate=[
                'id'=>'required'
            ];

            $alumno=Alumno::find($request->id);

            if(!$alumno){

                $datos['exito']=false;
                $datos['mensaje']='Alumno no encontrado. Intenta de nuevo.';

            }else{

                $alumno->delete();

                $datos['exito']=true;
                $datos['mensaje']='Alumno eliminado. Espera un momento.';

            }

        } catch (\Throwable $th) {

            $datos['exito']=false;
            $datos['mensaje']=$th->getMessage();

        }

        return response()->json($datos);
    }

    /**Búsqueda y validación de CURP
     * @param Request
     * @return json
     */
    public function curp(Request $request){
        $datos=array();
        $alumno=array();

        try {
            
            $request->validate=[
                'curp'=>'required'
            ];

            $alumno=Alumno::where('curpAlumno', '=', $request->curp)
            ->where('idIpes', '=', session()->get('idIpes'))
            ->first();

            if(!$alumno){

                $datos['exito']=false;
                $datos['mensaje']='Curp valido.';

            }else{

                if($alumno->curpAlumno==$request->curp){

                    $datos['exito']=true;
                    $datos['mensaje']='Curp invalido. Intenta con otro.';

                }else{

                    $datos['exito']=false;
                    $datos['mensaje']='Curp valido.';

                }

            }

        } catch (\Throwable $th) {
            
            $datos['exito']=true;
            $datos['mensaje']=$th->getMessage();

        }

        return response()->json($datos);
    }
}
