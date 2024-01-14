<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Autoridad;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carreras=array();

        if(session()->get('idIpes')){

            $carreras=Carrera::where('idIpes', '=', session()->get('idIpes'))->get();

            return view('carreras.index', ['carreras'=>$carreras]);

        }else{

            session()->get('idIpes');
            session()->get('nombreIpes');

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
        $autoridades=array();

        if(session()->get('idIpes')){

            $autoridades=Autoridad::all();
            
            return view('carreras.nuevo', ['autoridades'=>$autoridades]);

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
        $datos=array();
        $carrera=array();

        try {
            
            $request->validate=[
                'nombre'=>'required',
                'rvoe'=>'required',
                'clave'=>'required',
                'autoridad'=>'required'
            ];

            $carrera=new Carrera;
            $carrera->nombreCarrera=$request->nombre;
            $carrera->rvoeCarrera=$request->rvoe;
            $carrera->claveCarrera=$request->clave;
            $carrera->idAutoridad=$request->autoridad;
            $carrera->idIpes=session()->get('idIpes');
            $carrera->save();

            if($carrera->id){

                $datos['exito']=true;
                $datos['mensaje']='Carrera registrada correctamente.';

            }else{

                $datos['exito']=false;
                $datos['mensaje']='Registro no completado.';

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
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carrera=array();

        if(session()->get('idIpes')){

            $carrera=Carrera::find($id);

            return view('carreras.eliminar', ['carrera'=>$carrera]);

        }else{

            session()->forget('idIpes');
            session()->forget('nombreIpes');

            return view('institucion.login');

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carrera=array();
        $autoridades=array();

        if(session()->get('idIpes')){

            $carrera=Carrera::find($id);
            $autoridades=Autoridad::all();

            return view('carreras.editar', ['carrera'=>$carrera, 'autoridades'=>$autoridades]);

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
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $datos=array();
        $carrera=array();

        try {
            
            $request->validate=[
                'nombre'=>'required',
                'rvoe'=>'required',
                'clave'=>'required',
                'autoridad'=>'required',
                'id'=>'required'
            ];

            $carrera=Carrera::find($request->id);

            if(!$carrera){

                $datos['exito']=false;
                $datos['mensaje']='Carrera no encontrada. Intenta de nuevo.';

            }else{

                $carrera->nombreCarrera=$request->nombre;
                $carrera->rvoeCarrera=$request->rvoe;
                $carrera->claveCarrera=$request->clave;
                $carrera->idAutoridad=$request->autoridad;
                $carrera->save();

                if($carrera->id){

                    $datos['exito']=true;
                    $datos['mensaje']='Carrera actualizada.';

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
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $carrera=array();
        $datos=array();

        try {
            
            $request->validate=[
                'id'=>'required'
            ];

            $carrera=Carrera::find($request->id);

            if(!$carrera){

                $datos['exito']=false;
                $datos['mensaje']='Carrera no encontrada. Intentan de nuevo.';

            }else{

                $carrera->delete();

                $datos['exito']=true;
                $datos['mensaje']='Carrera eliminada.';

            }

        } catch (\Throwable $th) {
            
            $datos['exito']=false;
            $datos['mensaje']=$th->getMessage();

        }

        return response()->json($datos);
    }

    /**Búsqueda y comparación de RVOE
     * @param Request
     * @return json
     */
    public function rvoe(Request $request){
        $datos=array();
        $carrera=array();

        try {
            
            $request->validate=[
                'rvoe'=>'required'
            ];

            $carrera=Carrera::where('rvoeCarrera', '=', $request->rvoe)->first();

            if(!$carrera){

                $datos['exito']=false;
                $datos['mensaje']='RVOE valido.';

            }else{

                if($request->rvoe==$carrera->rvoeCarrera){

                    $datos['exito']=true;
                    $datos['mensaje']='RVOE registrado. Intenta con otro.';

                }else{

                    $datos['exito']=false;
                    $datos['mensaje']='RVOE valido.';

                }

            }

        } catch (\Throwable $th) {
            
            $datos['exito']=true;
            $datos['mensaje']=$th->getMessage();

        }

        return response()->json($datos);
    }

    /**Búsqueda y comparación de CLAVE
     * @param Request
     * @return json
     */
    public function clave(Request $request){
        $datos=array();
        $carrera=array();

        try {
            
            $request->validate=[
                'clave'=>'required'
            ];

            $carrera=Carrera::where('claveCarrera', '=', $request->clave)->first();

            if(!$carrera){

                $datos['exito']=false;
                $datos['mensaje']='Clave valida.';

            }else{

                if($request->clave==$carrera->claveCarrera){

                    $datos['exito']=true;
                    $datos['mensaje']='Clave registrada. Intenta con otra.';

                }else{

                    $datos['exito']=false;
                    $datos['mensaje']='Clave validad.';

                }

            }

        } catch (\Throwable $th) {
            
            $datos['exito']=true;
            $datos['mensaje']=$th->getMessage();

        }

        return response()->json($datos);
    }
}
