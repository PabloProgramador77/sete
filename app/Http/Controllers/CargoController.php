<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session()->get('idUsuario') && session()->get('categoriaUsuario')=='Admin'){

            $cargos=Cargo::all();

            return view('cargos.index', ['cargos'=>$cargos]);

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

            return view('cargos.nuevo');

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
        $cargo=array();

        try {
            
            $request->validate=[
                'nombre'=>'required'
            ];

            $cargo=new Cargo;
            $cargo->nombreCargo=$request->nombre;
            $cargo->save();

            if($cargo->id){

                $datos['exito']=true;
                $datos['mensaje']='Cargo de responsable registrado.';

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
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(session()->get('idUsuario') && session()->get('categoriaUsuario')=='Admin'){

            $cargo=Cargo::find($id);

            return view('cargos.eliminar', ['cargo'=>$cargo]);

        }else{

            session()->flush();

            return view('admin');

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(session()->get('idUsuario') && session()->get('categoriaUsuario')=='Admin'){

            $cargo=Cargo::find($id);

            return view('cargos.editar', ['cargo'=>$cargo]);

        }else{

            session()->flush();

            return view('admin');

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $datos=array();
        $cargo=array();

        try {
            
            $request->validate=[
                'nombre'=>'required',
                'id'=>'required'
            ];

            $cargo=Cargo::find($request->id);

            if(!$cargo){

                $datos['exito']=false;
                $datos['mensaje']='Cargo no encontrado.';

            }else{

                $cargo->nombreCargo=$request->nombre;
                $cargo->save();

                if($cargo->id){

                    $datos['exito']=true;
                    $datos['mensaje']='Cargo de responsable actualizado.';

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
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $datos=array();
        $cargo=array();

        try {
            
            $request->validate=[
                'id'=>'required'
            ];

            $cargo=Cargo::find($request->id);

            if(!$cargo){

                $datos['exito']=false;
                $datos['mensaje']='Cargo no encontrado.';

            }else{

                $cargo->delete();;
                $datos['exito']=true;
                $datos['mensaje']='Cargo de responsable eliminado.';

            }

        } catch (\Throwable $th) {
            
            $datos['exito']=false;
            $datos['mensaje']=$th->getMessage();
            
        }

        return response()->json($datos);
    }

    /**
     * Búsqueda y comparación de cargo
     * @param Request
     * @return json
     */
    public function validar(Request $request){
        $datos=array();
        $cargo=array();

        try {
            
            $request->validate=[
                'nombre'=>'required'
            ];

            $cargo=Cargo::where('nombreCargo', '=', $request->nombre)->first();

            if(!$cargo){

                $datos['exito']=false;
                $datos['mensaje']='Cargo permitido.';

            }else{

                if($cargo->nombreCargo==$request->nombre){

                    $datos['exito']=true;
                    $datos['mensaje']='Cargo no valido. Intenta con otro.';

                }else{

                    $datos['exito']=false;
                    $datos['mensaje']='Cargo permitido.';
                    
                }

            }

        } catch (\Throwable $th) {
            
            $datos['exito']=true;
            $datos['mensaje']=$th->getMessage();

        }

        return response()->json($datos);
    }
}
