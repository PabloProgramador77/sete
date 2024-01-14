<?php

namespace App\Http\Controllers;

use App\Models\Antecedente;
use App\Models\Alumno;
use App\Models\Estudio;
use App\Models\EntidadFederativa;
use Illuminate\Http\Request;

class AntecedenteController extends Controller
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
        if(session()->get('idIpes')){

            $antecedente=array();
            $alumno=array();
            $estudios=array();
            $entidades=array();

            $antecedente=Antecedente::where('idIpes', '=', session()->get('idIpes'))
            ->where('idAlumno', '=', $id)->first();

            $alumno=Alumno::find($id);

            $estudios=Estudio::all();

            $entidades=EntidadFederativa::all();

            return view('antecedentes.nuevo', ['alumno'=>$alumno, 'antecedente'=>$antecedente, 'estudios'=>$estudios, 'entidades'=>$entidades]);

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
        $antecedente=array();
        $datos=array();

        try {
            
            $request->validate=[
                'institucion'=>'required',
                'inicio'=>'required',
                'final'=>'required',
                'estudio'=>'required',
                'entidad'=>'required',
                'id'=>'required'
            ];

            $antecedente=New Antecedente;
            $antecedente->nombreAntecedente=$request->institucion;
            $antecedente->fechaInicioAntecedente=$request->inicio;
            $antecedente->fechaFinalAntecedente=$request->final;
            $antecedente->cedulaAntecedente=$request->cedula;
            $antecedente->idIpes=session()->get('idIpes');
            $antecedente->idEntidad=$request->entidad;
            $antecedente->idEstudio=$request->estudio;
            $antecedente->idAlumno=$request->id;
            $antecedente->save();

            if($antecedente->id){

                $datos['exito']=true;
                $datos['mensaje']='Antecedente registrado. Espera un momento.';

            }else{

                $datos['exito']=false;
                $datos['mensaje']='Registro incompleto. Intenta de nuevo.';

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
     * @param  \App\Models\Antecedente  $antecedente
     * @return \Illuminate\Http\Response
     */
    public function show(Antecedente $antecedente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Antecedente  $antecedente
     * @return \Illuminate\Http\Response
     */
    public function edit(Antecedente $antecedente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Antecedente  $antecedente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $antecedente=array();
        $datos=array();

        try {
            
            $request->validate=[
                'institucion'=>'required',
                'inicio'=>'required',
                'final'=>'required',
                'estudio'=>'required',
                'entidad'=>'required',
                'id'=>'required'
            ];

            $antecedente=Antecedente::where('idIpes', '=', session()->get('idIpes'))
            ->where('idAlumno', '=', $request->id)->first();

            if(!$antecedente){

                $datos['exito']=false;
                $datos['mensaje']='Antecedente no encontrado. Intenta de nuevo.';

            }else{
                
                $antecedente->nombreAntecedente=$request->institucion;
                $antecedente->fechaInicioAntecedente=$request->inicio;
                $antecedente->fechaFinalAntecedente=$request->final;
                $antecedente->cedulaAntecedente=$request->cedula;
                $antecedente->idEntidad=$request->entidad;
                $antecedente->idEstudio=$request->estudio;
                $antecedente->save();

                if($antecedente->id){

                    $datos['exito']=true;
                    $datos['mensaje']='Antecedente actualizado. Espera un momento.';

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Antecedente  $antecedente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Antecedente $antecedente)
    {
        //
    }
}
