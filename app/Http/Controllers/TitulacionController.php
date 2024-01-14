<?php

namespace App\Http\Controllers;

use App\Models\Titulacion;
use Illuminate\Http\Request;

class TitulacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session()->get('idUsuario') && session()->get('categoriaUsuario')=='Admin'){

            $titulaciones=Titulacion::all();

            return view('titulaciones.index', ['titulaciones'=>$titulaciones]);

        }else{

            session()->flush();

            return view('admin');

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(session()->get('idUsuario') && session()->get('categoriaUsuario')=='Admin'){

            return view('titulaciones.nuevo');

        }else{

            session()->flush();

            return view('admin');

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
        $titulacion=array();

        try {
            
            $request->validate=[
                'nombre'=>'required'
            ];

            $titulacion=new Titulacion;
            $titulacion->nombreTitulacion=$request->nombre;
            $titulacion->save();

            if($titulacion->id){

                $datos['exito']=true;
                $datos['mensaje']='Modalidad de titulación registrada.';

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
     * @param  \App\Models\Titulacion  $titulacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(session()->get('idUsuario') && session()->get('categoriaUsuario')=='Admin'){

            $titulacion=Titulacion::find($id);

            return view('titulaciones.eliminar', ['titulacion'=>$titulacion]);

        }else{

            session()->flush();

            return view('admin');

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Titulacion  $titulacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(session()->get('idUsuario') && session()->get('categoriaUsuario')=='Admin'){

            $titulacion=Titulacion::find($id);

            return view('titulaciones.editar', ['titulacion'=>$titulacion]);

        }else{

            session()->flush();

            return view('admin');

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Titulacion  $titulacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $datos=array();
        $titulacion=array();

        try {
            
            $request->validate=[
                'nombre'=>'required',
                'id'=>'required'
            ];

            $titulacion=Titulacion::find($request->id);

            if(!$titulacion){

                $datos['exito']=false;
                $datos['mensaje']='Modalidad de titulación no encontrada.';

            }else{

                $titulacion->nombreTitulacion=$request->nombre;
                $titulacion->save();

                if($titulacion->id){

                    $datos['exito']=true;
                    $datos['mensaje']='Modalidad de titulación actualizada.';

                }else{

                    $datos['exito']=false;
                    $datos['mensaje']='Actualización no completada.';

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
     * @param  \App\Models\Titulacion  $titulacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $datos=array();
        $titulacion=array();

        try {
            
            $request->validate=[
                'id'=>'required',
            ];

            $titulacion=Titulacion::find($request->id);

            if(!$titulacion){

                $datos['exito']=false;
                $datos['mensaje']='Modalidad de titulación no encontrada.';

            }else{

                $titulacion->delete();
                $datos['exito']=true;
                $datos['mensaje']='Modalidad de titulación eliminada.';

            }

        } catch (\Throwable $th) {
            
            $datos['exito']=false;
            $datos['mensaje']=$th->getMessage();

        }

        return response()->json($datos);
    }

    /**Busqueda y validacion de titulacion
     * @param Request
     * @return json
     */
    public function validar(Request $request){
        $datos=array();
        $titulacion=array();
        
        try {
            
            $request->validate=[
                'nombre'=>'required'
            ];

            $titulacion=Titulacion::where('nombreTitulacion', '=', $request->nombre)->first();

            if(!$titulacion){

                $datos['exito']=false;
                $datos['mensaje']='Titulación permitida.';

            }else{

                if($titulacion->nombreTitulacion==$request->nombre){

                    $datos['exito']=true;
                    $datos['mensaje']='Modalidad de titulación invalida. Intenta con otra.';

                }else{

                    $datos['exito']=false;
                    $datos['mensaje']='Titulación permitida.';

                }
            }

        } catch (\Throwable $th) {
            
            $datos['exito']=false;
            $datos['mensaje']=$th->getMessage();

        }

        return response()->json($datos);
    }
}
