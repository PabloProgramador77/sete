<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Crypt;

class UsuarioController extends Controller
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
    public function create()
    {
        return view('registro');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario=array();
        $datos=array();

        try {
            $request->validate=[
                'nombre'=>'required',
                'categoria'=>'required',
                'telefono'=>'required',
                'email'=>'required',
                'pass'=>'required'
            ];
    
            $usuario=new Usuario;
            $usuario->nombreUsuario=$request->nombre;
            $usuario->emailUsuario=$request->email;
            $usuario->passUsuario=crypt::encrypt($request->pass);
            $usuario->categoriaUsuario=$request->categoria;
            $usuario->estatusUsuario='Activo';
            $usuario->save();
    
            if($usuario->id){
                $datos['exito']=true;
            }else{
                $datos['exito']=false;
                $datos['mensaje']='Registro no completado.';
            }
        } catch (\Throwable $th) {
            $datos['exito']=false;
            $datos['mensaje']=$th.message();
        }
        
        return response()->json($datos);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        //
    }

    /**
     * Búsqueda y comparación de email de usuario
     * @param $request->email
     * @return json
     */
    public function validarEmail(Request $request){
        $usuario=array();
        $datos=array();

        $request->validate=[
            'email'=>'required'
        ];

        $usuario=Usuario::where('emailUsuario', '=', $request->email)
        ->first();

        if(!$usuario){
            $datos['exito']=true;
        }else{
            $datos['exito']=false;
        }

        return response()->json($datos);
    }

    /**
     * Identificacion de usuario(s)
     * @param Request
     * @return json
     */
    public function login(Request $request){
        $datos=array();
        $usuario=array();

        $request->validate=[
            'email'=>'required',
            'pass'=>'required'
        ];

        $usuario=Usuario::where('emailUsuario', '=', $request->email)
        ->first();

        if($request->pass==crypt::decrypt($usuario->passUsuario)){
            session()->put('idUsuario', $usuario->id);
            session()->put('categoriaUsuario', $usuario->categoriaUsuario);
            session()->put('nombreUsuario', $usuario->nombreUsuario);

            $datos['exito']=true;
        }else{
            $datos['exito']=false;
            $datos['mensaje']='La contraseña es incorrecta.';
        }

        return response()->json($datos);
    }

    /**
     * Cierre de sesión de usuario(s)
     */
    public function logout(){
        session()->flush();
        
        return view('admin');
    }
}
