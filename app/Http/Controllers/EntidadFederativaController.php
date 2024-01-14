<?php

namespace App\Http\Controllers;

use App\Models\EntidadFederativa;
use Illuminate\Http\Request;

class EntidadFederativaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session()->get('idUsuario') && session()->get('categoriaUsuario')){
            $entidades=array();

            $entidades=EntidadFederativa::all();

            return view('entidades.index', ['entidades'=>$entidades]);
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
        if(session()->get('idUsuario') && session()->get('categoriaUsuario')){
            return view('entidades.nuevo');
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
        $entidad=array();

        $request->validate=[
            'nombre'=>'required'
        ];

        $entidad=new EntidadFederativa;
        $entidad->nombreEntidad=$request->nombre;
        $entidad->save();

        if($entidad->id){
            $datos['exito']=true;
        }else{
            $datos['exito']=false;
            $datos['mensaje']='Registro no completado.';
        }

        return response()->json($datos);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EntidadFederativa  $entidadFederativa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entidad=array();

        if(session()->get('idUsuario') && session()->get('categoriaUsuario')){
            $entidad=EntidadFederativa::find($id);

            return view('entidades.eliminar', ['entidad'=>$entidad]);
        }else{
            session()->flush();

            return view('admin');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EntidadFederativa  $entidadFederativa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entidad=array();

        if(session()->get('idUsuario') && session()->get('categoriaUsuario')){
            $entidad=EntidadFederativa::find($id);

            return view('entidades.editar', ['entidad'=>$entidad]);
        }else{
            session()->flush();

            return view('admin');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EntidadFederativa  $entidadFederativa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $entidad=array();
        $datos=array();

        $request->validate=[
            'id'=>'required',
            'nombre'=>'required'
        ];

        $entidad=EntidadFederativa::find($request->id);

        if(!$entidad){
            $datos['exito']=false;
            $datos['mensaje']='Actualización interrumpida.';
        }else{
            $entidad->nombreEntidad=$request->nombre;
            $entidad->save();

            if($entidad->id){
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
     * @param  \App\Models\EntidadFederativa  $entidadFederativa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $entidad=array();
        $datos=array();

        $request->validate=[
            'id'=>'required'
        ];

        $entidad=EntidadFederativa::find($request->id);

        if(!$entidad){
            $datos['exito']=false;
            $datos['mensaje']='Eliminación no ejecutada.';
        }else{
            $entidad->delete();

            $datos['exito']=true;
        }

        return response()->json($datos);
    }

    /**
     * Validación de nombre
     * @param Request
     * @return json
     */
    public function validar(Request $request){
        $datos=array();
        $entidad=array();

        $request->validate=[
            'nombre'=>'required'
        ];

        $entidad=EntidadFederativa::where('nombreEntidad', '=', $request->nombre)
        ->first();

        if($entidad){
            if($entidad->nombreEntidad==$request->nombre){
                $datos['exito']=true;
            }else{
                $datos['exito']=false;
            }
        }

        return response()->json($datos);
    }
}
