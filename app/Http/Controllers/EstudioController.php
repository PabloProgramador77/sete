<?php

namespace App\Http\Controllers;

use App\Models\Estudio;
use Illuminate\Http\Request;

class EstudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session()->get('idUsuario') && session()->get('categoriaUsuario')=='Admin'){
            $estudios=array();

            $estudios=Estudio::all();

            return view('estudios.index', ['estudios'=>$estudios]);
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
            return view('estudios.nuevo');
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
        $estudio=array();

        $request->validate=[
            'nombre'=>'required'
        ];

        $estudio=new Estudio;
        $estudio->nombreEstudio=$request->nombre;
        $estudio->save();

        if($estudio->id){
            $datos['exito']=true;
        }else{
            $datos['exito']=false;
            $datos['mensaje']='Registro no ejecutado.';
        }

        return response()->json($datos);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estudio  $estudio
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(session()->get('idUsuario') && session()->get('categoriaUsuario')=='Admin'){
            $estudio=array();

            $estudio=Estudio::find($id);

            return view('estudios.eliminar', ['estudio'=>$estudio]);
        }else{
            session()->flush();

            return view('admin');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estudio  $estudio
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(session()->get('idUsuario') && session()->get('categoriaUsuario')=='Admin'){
            $estudio=array();

            $estudio=Estudio::find($id);

            return view('estudios.editar', ['estudio'=>$estudio]);
        }else{
            session()->flush();

            return view('admin');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estudio  $estudio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $estudio=array();
        $datos=array();

        $request->validate=[
            'nombre'=>'required',
            'id'=>'required'
        ];

        $estudio=Estudio::find($request->id);

        if(!$estudio){
            $datos['exito']=false;
            $datos['mensaje']='Actualización interrumpida.';
        }else{
            $estudio->nombreEstudio=$request->nombre;
            $estudio->save();
            
            if($estudio->id){
                $datos['exito']=true;
            }else{
                $datos['exito']=false;
                $datos['mensaje']='Actualización no ejecutada.';
            }
        }

        return response()->json($datos);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estudio  $estudio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $estudio=array();
        $datos=array();

        $request->validate=[
            'id'=>'required'
        ];

        $estudio=Estudio::find($request->id);

        if(!$estudio){
            $datos['exito']=false;
            $datos['mensaje']='Eliminación no ejecutada.';
        }else{
            $estudio->delete();

            $datos['exito']=true;
        }

        return response()->json($datos);
    }

    /**
     * Validacion de nombre de estudio
     * @param Request
     * @return json
     */
    public function validar(Request $request){
        $datos=array();
        $estudio=array();

        $request->validate=[
            'nombre'=>'required'
        ];

        $estudio=Estudio::where('nombreEstudio', '=', $request->nombre)
        ->first();

        if(!$estudio){
            $datos['exito']=false;
        }else{
            if($request->nombre==$estudio->nombreEstudio){
                $datos['exito']=true;
            }else{
                $datos['exito']=false;
            }
        }

        return response()->json($datos);
    }
}
