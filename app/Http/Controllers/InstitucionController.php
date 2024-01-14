<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institucion;
use Crypt;

class InstitucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if(session()->get('idIpes') && session()->get('nombreIpes')){

            return view('contenido');

        }else{

            session()->forget('idIpes');
            session()->forget('nombreIpes');

            return view('institucion/login');

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $institucion=array();

        try {
            
            $request->validate=[
                'nombre'=>'required',
                'clave'=>'required',
                'email'=>'required',
                'pass'=>'required'
            ];

            $institucion=new Institucion;
            $institucion->nombreIpes=$request->nombre;
            $institucion->claveIpes=$request->clave;
            $institucion->emailIpes=$request->email;
            $institucion->passIpes=Crypt::encrypt($request->pass);
            $institucion->estatusIpes='Activo';
            $institucion->save();

            if($institucion->id){

                mkdir(public_path('files/llaves/').$institucion->claveIpes);
                mkdir(public_path('files/xml/').$institucion->claveIpes);

                $datos['exito']=true;
                $datos['mensaje']='IPES registrada correctamente. Espera un momento.';

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $institucion=array();

        if(session()->get('idIpes') && session()->get('nombreIpes')){

            $institucion=Institucion::find(session()->get('idIpes'));

            return view('institucion.perfil', ['institucion'=>$institucion]);

        }else{

            session()->forget('idIpes');
            session()->forget('nombreIpes');

            return view('institucion/login');

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $datos=array();
        $institucion=array();

        try {
            
            $request->validate=[
                'nombre'=>'required',
                'clave'=>'required',
                'email'=>'required',
                'id'=>'required'
            ];

            $institucion=Institucion::find($request->id);

            if(!$institucion){

                $datos['exito']=false;
                $datos['mensaje']='I.P.E.S. no encontrada. Intenta de nuevo';

            }else{

                $institucion->nombreIpes=$request->nombre;
                $institucion->claveIpes=$request->clave;
                $institucion->emailIpes=$request->email;
                $institucion->save();

                if($institucion->id){

                    $datos['exito']=true;
                    $datos['mensaje']='Perfil I.P.E.S. actualizado.';

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**Formulario de registro */
    public function registro(){
        if(!session()->get('idInstitucion')){
            return view('institucion.registro');
        }else{
            return redirect('/');
        }
    }

    /**Formulario de acceso */
    public function login(){
        if(!session()->get('idIpes')){
            return view('institucion.login');
        }else{
            return redirect('/');
        }
    }

    /**Búsqueda y validación de nombre
     * @param Request
     * @return json
     */
    public function validarNombre(Request $request){
        $datos=array();
        $institucion=array();

        try {
            
            $request->validate=[
                'nombre'=>'required'
            ];

            $institucion=Institucion::where('nombreIpes', '=', $request->nombre)->first();

            if(!$institucion){

                $datos['exito']=false;
                $datos['mensaje']='IPES permitida.';

            }else{

                if($request->nombre==$institucion->nombreIpes){

                    $datos['exito']=true;
                    $datos['mensaje']='IPES ya registrada. Intenta de nuevo.';

                }else{

                    $datos['exito']=false;
                    $datos['mensaje']='IPES permitida.';

                }

            }

        } catch (\Throwable $th) {
            
            $datos['exito']=true;
            $datos['mensaje']=$th->getMessage();

        }

        return response()->json($datos);
    }

    /**Búsqueda y validación de clave
     * @param Request
     * @return json
     */
    public function validarClave(Request $request){
        $datos=array();
        $institucion=array();

        try {
            
            $request->validate=[
                'clave'=>'required'
            ];

            $institucion=Institucion::where('claveIpes', '=', $request->clave)->first();

            if(!$institucion){

                $datos['exito']=false;
                $datos['mensaje']='IPES permitida.';

            }else{

                if($request->clave==$institucion->claveIpes){

                    $datos['exito']=true;
                    $datos['mensaje']='Clave registrada. Intenta de nuevo.';

                }else{

                    $datos['exito']=false;
                    $datos['mensaje']='IPES permitida.';

                }

            }

        } catch (\Throwable $th) {
            
            $datos['exito']=true;
            $datos['mensaje']=$th->getMessage();

        }

        return response()->json($datos);
    }

    /**Búsqueda y validación de email
     * @param Request
     * @return json
     */
    public function validarEmail(Request $request){
        $datos=array();
        $institucion=array();

        try {
            
            $request->validate=[
                'email'=>'required'
            ];

            $institucion=Institucion::where('emailIpes', '=', $request->email)->first();

            if(!$institucion){

                $datos['exito']=false;
                $datos['mensaje']='IPES permitida.';

            }else{

                if($request->email==$institucion->emailIpes){

                    $datos['exito']=true;
                    $datos['mensaje']='Clave registrada. Intenta de nuevo.';

                }else{

                    $datos['exito']=false;
                    $datos['mensaje']='IPES permitida.';

                }

            }

        } catch (\Throwable $th) {
            
            $datos['exito']=true;
            $datos['mensaje']=$th->getMessage();

        }

        return response()->json($datos);
    }

    /**Validación de email para LOGIN 
     * @param Request
     * @return json
    */
    public function validarLogin(Request $request){
        $datos=array();
        $institucion=array();

        try {
            
            $request->validate=[
                'email'=>'required'
            ];

            $institucion=Institucion::where('emailIpes', '=', $request->email)->first();

            if(!$institucion){

                $datos['exito']=false;
                $datos['mensaje']='IPES no registrada. Intenta de nuevo.';

            }else{

                if($request->email==$institucion->emailIpes){

                    $datos['exito']=true;
                    $datos['mensaje']='IPES registrada. Continua.';

                }else{

                    $datos['exito']=false;
                    $datos['mensaje']='IPES no registrada. Intenta de nuevo.';

                }

            }

        } catch (\Throwable $th) {
            
            $datos['exito']=true;
            $datos['mensaje']=$th->getMessage();

        }

        return response()->json($datos);
    }

    /**Validación de contrase de acceso
     * @param Request
     * @return json
     */
    public function validarPass(Request $request){
        $datos=array();
        $institucion=array();

        try {
            
            $request->validate=[
                'email'=>'required',
                'pass'=>'required'
            ];

            $institucion=Institucion::where('emailIpes', '=', $request->email)->first();

            if(!$institucion){

                $datos['exito']=false;
                $datos['mensaje']='IPES no encontrada. Intenta de nuevo.';

            }else{

                if($request->email==$institucion->emailIpes){

                    if($request->pass==Crypt::decrypt($institucion->passIpes)){

                        $datos['exito']=true;
                        $datos['mensaje']='Bienvenido '.$institucion->nombreIpes.'. Espera un momento.';

                        session()->put('idIpes', $institucion->id);
                        session()->put('nombreIpes', $institucion->nombreIpes);
                        session()->put('claveIpes', $institucion->claveIpes);

                    }else{

                        $datos['exito']=false;
                        $datos['mensaje']='Contraseña incorrecta.';

                    }

                }else{

                    $datos['exito']=false;
                    $datos['mensaje']='IPES no encontrada. Intenta de nuevo.';

                }

            }

        } catch (\Throwable $th) {
            
            $datos['exito']=true;
            $datos['mensaje']=$th->getMessage();

            session()->flush();

        }

        return response()->json($datos);
    }

    /**Cierre de sesión IPES
     * 
     */
    public function logout(){
        session()->forget('idIpes');
        session()->forget('nombreIpes');

        return view('institucion.login');
    }
}
