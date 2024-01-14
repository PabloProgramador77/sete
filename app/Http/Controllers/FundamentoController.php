<?php

namespace App\Http\Controllers;

use App\Models\Fundamento;
use Illuminate\Http\Request;

class FundamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session()->get('idUsuario') && session()->get('categoriaUsuario')=='Admin'){

            $fundamentos=Fundamento::all();

            return view('fundamentos.index', ['fundamentos'=>$fundamentos]);

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

            return view('fundamentos.nuevo');

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
        $fundamento=array();

        try {
            
            $request->validate=[
                'nombre'=>'required'
            ];

            $fundamento=new Fundamento;
            $fundamento->nombreFundamento=$request->nombre;
            $fundamento->save();

            if($fundamento->id){

                $datos['exito']=true;
                $datos['mensaje']='Fundamento registrado.';

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
     * @param  \App\Models\Fundamento  $fundamento
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(session()->get('idUsuario') && session()->get('categoriaUsuario')=='Admin'){

            $fundamento=Fundamento::find($id);

            return view('fundamentos.eliminar', ['fundamento'=>$fundamento]);

        }else{

            session()->flush();

            return view('admin');

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fundamento  $fundamento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(session()->get('idUsuario') && session()->get('categoriaUsuario')=='Admin'){

            $fundamento=Fundamento::find($id);

            return view('fundamentos.editar', ['fundamento'=>$fundamento]);

        }else{

            session()->flush();

            return view('admin');

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fundamento  $fundamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $datos=array();
        $fundamento=array();

        try {
            
            $request->validate=[
                'nombre'=>'required',
                'id'=>'required'
            ];

            $fundamento=Fundamento::find($request->id);

            if(!$fundamento){

                $datos['exito']=false;
                $datos['mensaje']='Fundamento no encontrado.';

            }else{

                $fundamento->nombreFundamento=$request->nombre;
                $fundamento->save();

                if($fundamento->id){

                    $datos['exito']=true;
                    $datos['mensaje']='Fundamento actualizado.';

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
     * @param  \App\Models\Fundamento  $fundamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $datos=array();
        $fundamento=array();

        try {
            
            $request->validate=[
                'id'=>'required'
            ];

            $fundamento=Fundamento::find($request->id);

            if(!$fundamento){

                $datos['exito']=false;
                $datos['mensaje']='Fundamento no encontrado.';

            }else{

                $fundamento->delete();
                $datos['exito']=true;
                $datos['mensaje']='Fundamento de S.S. eliminado.';

            }

        } catch (\Throwable $th) {
            
            $datos['exito']=false;
            $datos['mensaje']=$th->getMessage();

        }

        return response()->json($datos);
    }

    /**Búsqueda y validacion de fundamento 
     * @param Request
     * @return json
    */
    public function validar(Request $request){
        $datos=array();
        $fundamento=array();

        try {
            
            $request->validate=[
                'nombre'=>'required'
            ];

            $fundamento=Fundamento::where('nombreFundamento', '=', $request->nombre)->first();

            if(!$fundamento){

                $datos['exito']=false;
                $datos['mensaje']='Fundamento permitido.';

            }else{

                if($fundamento->nombreFundamento==$request->nombre){

                    $datos['exito']=true;
                    $datos['mensaje']='Fundamento invalido. Intenta con otro.';

                }else{

                    $datos['exito']=false;
                    $datos['mensaje']='Fundamento permitido.';

                }

            }

        } catch (\Throwable $th) {
            
            $datos['exito']=true;
            $datos['mensaje']=$th->getMessage();

        }

        return response()->json($datos);
    }
}
