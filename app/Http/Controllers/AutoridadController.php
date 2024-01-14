<?php

namespace App\Http\Controllers;

use App\Models\Autoridad;
use Illuminate\Http\Request;

class AutoridadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session()->get('idUsuario') && session()->get('categoriaUsuario')=='Admin'){
            $autoridades=array();

            $autoridades=Autoridad::all();

            return view('autoridades.index', ['autoridades'=>$autoridades]);
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
            return view('autoridades.nuevo');
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
        $autoridad=array();
        $datos=array();

        $request->validate=[
            'nombre'=>'required'
        ];

        $autoridad=new Autoridad;
        $autoridad->nombreAutoridad=$request->nombre;
        $autoridad->save();

        if($autoridad->id){
            $datos['exito']=true;
        }else{
            $datos['exito']=false;
            $datos['mensaje']='Registro incompleto.';
        }

        return response()->json($datos);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Autoridad  $autoridad
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(session()->get('idUsuario') && session()->get('categoriaUsuario')=='Admin'){

            $autoridad=Autoridad::find($id);

            return view('autoridades.eliminar', ['autoridad'=>$autoridad]);

        }else{

            session()->flush();

            return view('admin');

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Autoridad  $autoridad
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(session()->get('idUsuario') && session()->get('categoriaUsuario')=='Admin'){

            $autoridad=Autoridad::find($id);

            return view('autoridades.editar', ['autoridad'=>$autoridad]);

        }else{

            session()->flush();

            return view('admin');

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Autoridad  $autoridad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $datos=array();
        $autoridad=array();

        try {
            
            $request->validate=[
                'nombre'=>'required',
                'id'=>'required'
            ];

            $autoridad=Autoridad::find($request->id);

            if(!$autoridad){

                $datos['exito']=false;
                $datos['mensaje']='Autoridad de RVOE no encontrada.';

            }else{

                $autoridad->nombreAutoridad=$request->nombre;
                $autoridad->save();

                if($autoridad->id){

                    $datos['exito']=true;
                    $datos['mensaje']='Autoridad de RVOE actualizada.';

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
     * @param  \App\Models\Autoridad  $autoridad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $datos=array();
        $autoridad=array();

        try {
            
            $request->validate=[
                'id'=>'required'
            ];

            $autoridad=Autoridad::find($request->id);

            if(!$autoridad){

                $datos['exito']=false;
                $datos['mensaje']='Autoridad de RVOE no encontrada.';

            }else{

                $autoridad->delete();
                $datos['exito']=true;
                $datos['mensaje']='Autoridad de RVOE eliminada.';

            }

        } catch (\Throwable $th) {
            
            $datos['exito']=false;
            $datos['mensaje']=$th->getMessage();

        }

        return response()->json($datos);
    }

    /**
     * Validacion de nombre de autoridad
     * @param Request
     * @return json
     */
    public function validar(Request $request){
        $autoridad=array();
        $datos=array();

        $request->validate=[
            'nombre'=>'required'
        ];

        $autoridad=Autoridad::where('nombreAutoridad', '=', $request->nombre)
        ->first();

        if(!$autoridad){
            $datos['exito']=false;
        }else{
            if($request->nombre==$autoridad->nombreAutoridad){
                $datos['exito']=true;
            }else{
                $datos['exito']=false;
            }
        }

        return response()->json($datos);
    }
}
