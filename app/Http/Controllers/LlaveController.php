<?php

namespace App\Http\Controllers;

use App\Models\Llave;
use App\Models\Responsable;
use Illuminate\Http\Request;
use Crypt;

class LlaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $responsable=array();

        if(session()->get('idIpes')){

            $responsable=Responsable::find($id);

            return view('responsables.archivos', ['responsable'=>$responsable]);

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
        $llaves=array();

        try {
            
            $request->validate=[
                'responsable'=>'required',
                'pass'=>'required'
            ];

            $llaves=new Llave;
            $llaves->nombreLlavePublica=$_FILES['cer']['name'];
            $llaves->nombreLlavePrivada=$_FILES['key']['name'];
            $llaves->passLlavePrivada=Crypt::encrypt($request->pass);
            $llaves->idResponsable=$request->responsable;
            $llaves->idIpes=session()->get('idIpes');
            $llaves->save();

            if($llaves->id){

                if(move_uploaded_file($_FILES['cer']['tmp_name'], public_path('files/llaves/'.session()->get('claveIpes').'/'.$_FILES['cer']['name']))){

                    if(move_uploaded_file($_FILES['key']['tmp_name'], public_path('files/llaves/'.session()->get('claveIpes').'/'.$_FILES['key']['name']))){
    
                        $datos['exito']=true;
                        $datos['mensaje']='Registro de llaves completo.';
    
                    }else{
    
                        $datos['exito']=false;
                        $datos['mensaje']='Carga de llave privada incompleta. Intenta de nuevo.';
    
                    }
    
                }else{
    
                    $datos['exito']=false;
                    $datos['mensaje']='Carga de llave pública incompleta. Intenta de nuevo.';
    
                }

            }else{

                $datos['exito']=false;
                $datos['mensaje']='Registro de llaves incompleto. Intenta de nuevo.';

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
     * @param  \App\Models\Llave  $llave
     * @return \Illuminate\Http\Response
     */
    public function show(Llave $llave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Llave  $llave
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $llaves=array();

        if(session()->get('idIpes')){

            $llaves=Llave::where('idResponsable', '=', $id)
            ->where('idIpes', '=', session()->get('idIpes'))
            ->first();

            return view('responsables.cer', ['llaves'=>$llaves]);

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
     * @param  \App\Models\Llave  $llave
     * @return \Illuminate\Http\Response
     */
    public function actualizarCer(Request $request)
    {
        $datos=array();
        $llaves=array();

        try {
            
            $request->validate=[
                'id'=>'required'
            ];

            if($_FILES['cer']['type']=='application/x-x509-ca-cert'){

                $llaves=Llave::find($request->id);

                if(!$llaves){

                    $datos['exito']=false;
                    $datos['mensaje']='Llave pública no encontrada. Intenta de nuevo.';

                }else{

                    $llaves->nombreLlavePublica=$_FILES['cer']['name'];
                    $llaves->save();

                    if($llaves->id){

                        if(move_uploaded_file($_FILES['cer']['tmp_name'], public_path('files/llaves/'.session()->get('claveIpes').'/'.$_FILES['cer']['name']))){

                            $datos['exito']=true;
                            $datos['mensaje']='Llave pública actualizada. Espera un momento.';

                        }else{

                            $datos['exito']=false;
                            $datos['mensaje']='Carga de llave pública incompleta. Intenta de nuevo.';

                        }

                    }else{

                        $datos['exito']=false;
                        $datos['mensaje']='Actualización incompleta. Intenta de nuevo.';

                    }

                }

            }else{

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
     * @param  \App\Models\Llave  $llave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Llave $llave)
    {
        //
    }

    /**
     * Búsqueda y verificación de CER
     * @param Request
     * @return json
     */
    public function cer(Request $request){
        $datos=array();
        $llave=array();

        try {
            
            $request->validate=[
                'responsable'=>'required'
            ];

            if($_FILES['cer']['type']=='application/x-x509-ca-cert'){

                $llave=Llave::where('idResponsable', '=', $request->responsable)
                ->where('nombreLlavePublica', '=', $_FILES['cer']['name'])
                ->where('idIpes', '=', session()->get('idIpes'))
                ->first();

                if(!$llave){

                    $datos['exito']=false;
                    $datos['mensaje']='Llave pública valida.';

                }else{

                    if($llave->nombreLlavePublica==$_FILES['cer']['name']){

                        $datos['exito']=true;
                        $datos['mensaje']='Llave pública ya registrada. Intenta con otra.';

                    }else{

                        $datos['exito']=false;
                        $datos['mensaje']='Llave pública valida.';

                    }

                }

            }else{

                $datos['exito']=true;
                $datos['mensaje']='Tipo de archivo no permitido. Intenta con otro.';

            }

        } catch (\Throwable $th) {

            $datos['exito']=true;
            $datos['mensaje']=$th->getMessage();

        }

        return response()->json($datos);
    }

    /**
     * Búsqueda y validación de archivo KEY
     * @param Request
     * @return json
     */
    public function key(Request $request){
        $datos=array();
        $llave=array();

        try {
            
            $request->validate=[
                'responsable'=>'required'
            ];

            if($_FILES['key']['type']=='application/octet-stream' || $_FILES['key']['type']=='application/x-pem-file' || $_FILES['key']['type']=='application/pkcs8'){

                $llave=Llave::where('idResponsable', '=', $request->responsable)
                ->where('idIpes', '=', session()->get('idIpes'))
                ->where('nombreLlavePrivada', '=', $_FILES['key']['name'])
                ->first();

                if(!$llave){

                    $datos['exito']=false;
                    $datos['mensaje']='Llave privada valida.';

                }else{

                    if($llave->nombreLlavePrivada==$_FILES['key']['name']){

                        $datos['exito']=true;
                        $datos['mensaje']='Llave privada ya registrada. Intenta con otra.';

                    }else{

                        $datos['exito']=false;
                        $datos['mensaje']='Llave privada valida.';

                    }

                }

            }else{

                $datos['exito']=true;
                $datos['mensaje']='Tipo de archivo invalido. Intenta con otro.';

            }

        } catch (\Throwable $th) {

            $datos['exito']=true;
            $datos['mensaje']=$th->getMessage();

        }

        return response()->json($datos);
    }

    /**
     * Edición de llave privada
     * @param $id
     * @return view
     */
    public function editPrivada($id)
    {
        $llaves=array();

        if(session()->get('idIpes')){

            $llaves=Llave::find($id);

            return view('responsables.key', ['llaves'=>$llaves]);

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
     * @param  \App\Models\Llave  $llave
     * @return \Illuminate\Http\Response
     */
    public function actualizarKey(Request $request)
    {
        $datos=array();
        $llaves=array();

        try {
            
            $request->validate=[
                'id'=>'required'
            ];

            if($_FILES['key']['type']=='application/octet-stream' || $_FILES['key']['type']=='application/x-pem-file' || $_FILES['key']['type']=='application/pkcs8'){

                $llaves=Llave::find($request->id);

                if(!$llaves){

                    $datos['exito']=false;
                    $datos['mensaje']='Llave privada no encontrada. Intenta de nuevo.';

                }else{

                    $llaves->nombreLlavePrivada=$_FILES['key']['name'];
                    $llaves->save();

                    if($llaves->id){

                        if(move_uploaded_file($_FILES['key']['tmp_name'], public_path('files/llaves/'.session()->get('claveIpes').'/'.$_FILES['key']['name']))){

                            $datos['exito']=true;
                            $datos['mensaje']='Llave privada actualizada. Espera un momento.';

                        }else{

                            $datos['exito']=false;
                            $datos['mensaje']='Carga de llave privada incompleta. Intenta de nuevo.';

                        }

                    }else{

                        $datos['exito']=false;
                        $datos['mensaje']='Actualización incompleta. Intenta de nuevo.';

                    }

                }

            }else{

            }

        } catch (\Throwable $th) {
            
            $datos['exito']=false;
            $datos['mensaje']=$th->getMessage();

        }


        return response()->json($datos);
    }

    /**
     * Edición de llave privada
     * @param $id
     * @return view
     */
    public function editPass($id)
    {
        $llaves=array();

        if(session()->get('idIpes')){

            $llaves=Llave::find($id);
            $llaves->passLlavePrivada=Crypt::decrypt($llaves->passLlavePrivada);

            return view('responsables.password', ['llaves'=>$llaves]);

        }else{

            session()->forget('idIpes');
            session()->forget('nombreIpes');

            return view('institucion.login');

        }
    }

    /**
     * Actualización de contraseña
     * @param Request
     * @return json
     */
    public function actualizarPass(Request $request){
        $datos=array();
        $llaves=array();

        try {
            
            $request->validate=[
                'pass'=>'required',
                'id'=>'required'
            ];

            $llaves=Llave::find($request->id);

            if(!$llaves){

                $datos['exito']=false;
                $datos['mensaje']='Contraseña no encontrada. Intenta de nuevo.';

            }else{

                $llaves->passLlavePrivada=Crypt::encrypt($request->pass);
                $llaves->save();

                if($llaves->id){

                    $datos['exito']=true;
                    $datos['mensaje']='Contraseña actualizada. Espera un momento.';

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
}
