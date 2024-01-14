<?php

namespace App\Http\Controllers;

use App\Models\Responsable;
use App\Models\Cargo;
use App\Models\Llave;
use Illuminate\Http\Request;
use Crypt;

class ResponsableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $responsables=array();

        if(session()->get('idIpes')){

            $responsables=Responsable::select('responsables.id', 'responsables.nombreResponsable', 'responsables.apellido1Responsable', 'responsables.apellido2Responsable', 'responsables.created_at', 'llaves.nombreLlavePublica')
            ->join('llaves', 'responsables.id', '=', 'llaves.idResponsable')
            ->where('responsables.idIpes', '=', session()->get('idIpes'))->get();

            return view('responsables.index', ['responsables'=>$responsables]);

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
        $cargos=array();

        if(session()->get('idIpes')){

            $cargos=Cargo::all();

            return view('responsables.nuevo', ['cargos'=>$cargos]);

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
        $responsable=array();

        try {
            
            $request->validate=[
                'nombre'=>'required',
                'apellido1'=>'required',
                'curp'=>'required',
                'cargo'=>'required',
            ];

            $responsable=new Responsable;
            $responsable->nombreResponsable=$request->nombre;
            $responsable->apellido1Responsable=$request->apellido1;
            $responsable->apellido2Responsable=$request->apellido2;
            $responsable->curpResponsable=$request->curp;
            $responsable->tituloResponsable=$request->titulo;
            $responsable->idIpes=session()->get('idIpes');
            $responsable->idCargo=$request->cargo;
            $responsable->save();

            if($responsable->id){

                $llaves=new Llave;
                $llaves->nombreLlavePublica='undefined.cer';
                $llaves->nombreLlavePrivada='undefined.key';
                $llaves->passLlavePrivada=Crypt::encrypt('pabloprogramador');
                $llaves->idResponsable=$responsable->id;
                $llaves->idIpes=session()->get('idIpes');
                $llaves->save();

                $datos['exito']=true;
                $datos['mensaje']='Responsable registrado correctamente.';

            }else{

                $datos['exito']=false;
                $datos['mensaje']='Registro no completado. Intenta de nuevo.';

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
     * @param  \App\Models\Responsable  $responsable
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $responsable=array();

        if(session()->get('idIpes')){

            $responsable=Responsable::find($id);

            return view('responsables.eliminar', ['responsable'=>$responsable]);

        }else{

            session()->forget('idIpes');
            session()->forget('nombreIpes');

            return view('institucion.login');

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Responsable  $responsable
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $responsable=array();
        $cargos=array();

        if(session()->get('idIpes')){

            $responsable=Responsable::find($id);
            $cargos=Cargo::all();

            return view('responsables.editar', ['responsable'=>$responsable, 'cargos'=>$cargos]);

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
     * @param  \App\Models\Responsable  $responsable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $datos=array();
        $responsable=array();

        try {
            
            $request->validate=[
                'nombre'=>'required',
                'apellido1'=>'required',
                'curp'=>'required',
                'cargo'=>'required',
                'id'=>'required'
            ];

            $responsable=Responsable::where('id', '=', $request->id)
            ->where('idIpes', '=', session()->get('idIpes'))
            ->first();

            if(!$responsable){

                $datos['exito']=false;
                $datos['mensaje']='Responsable no encontrado. Intenta de nuevo.';

            }else{

                $responsable->nombreResponsable=$request->nombre;
                $responsable->apellido1Responsable=$request->apellido1;
                $responsable->apellido2Responsable=$request->apellido2;
                $responsable->curpResponsable=$request->curp;
                $responsable->tituloResponsable=$request->titulo;
                $responsable->idCargo=$request->cargo;
                $responsable->save();

                if($responsable->id){

                    $datos['exito']=true;
                    $datos['mensaje']='Responsable actualizado.';

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
     * @param  \App\Models\Responsable  $responsable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $datos=array();
        $responsable=array();

        try {
            
            $request->validate=[
                'id'=>'required'
            ];

            $responsable=Responsable::find($request->id);

            if(!$responsable){

                $datos['exito']=false;
                $datos['mensaje']='Responsable no encontrado. Intenta de nuevo.';

            }else{

                $responsable->delete();

                $datos['exito']=true;
                $datos['mensaje']='Responsable eliminado.';

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
        $responsable=array();

        try {
            
            $request->validate=[
                'curp'=>'required'
            ];

            $responsable=Responsable::where('curpResponsable', '=', $request->curp)->first();

            if(!$responsable){

                $datos['exito']=false;
                $datos['mensaje']='CURP valido.';

            }else{

                if($request->curp==$responsable->curpResponsable){

                    $datos['exito']=true;
                    $datos['mensaje']='CURP registrado. Intenta con otro.';

                }else{

                    $datos['exito']=false;
                    $datos['mensaje']='CURP valido.';

                }

            }

        } catch (\Throwable $th) {
            
            $datos['exito']=true;
            $datos['mensaje']=$th->getMessage();

        }

        return response()->json($datos);
    }

    
}
