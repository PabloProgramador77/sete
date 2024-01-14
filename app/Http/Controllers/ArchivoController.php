<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use App\Models\Expedicion;
use App\Models\Responsable;
use App\Models\Institucion;
use App\Models\Alumno;
use App\Models\Carrera;
use App\Models\Antecedente;
use App\Models\Llave;
use Illuminate\Http\Request;
use XMLWriter;
use Carbon\Carbon;
use Crypt;
use Stripe;

class ArchivoController extends Controller
{
    /**
     * Constructor
     */
    public function __construct(){
        $this->stripe=new \Stripe\StripeClient('sk_test_QcRYqEW8XNkmML3Q0iG19xU5003hKMM2Nc');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $archivos=array();

        if(session()->get('idIpes')){

            $archivos=Archivo::where('idIpes', '=', session()->get('idIpes'))->get();

            return view('archivos.index', ['archivos'=>$archivos]);

        }else{

            session()->forget('idIpes');
            session()->forget('nombreIpes');
            session()->forget('claveIpes');

            return view('institucion.login');

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $expedicion=array();
        $archivo=array();

        if(session()->get('idIpes')){

            $archivo=Archivo::where('idExpedicion', '=', $id)->first();

            if(!$archivo){

                $expedicion=Expedicion::find($id);
                
            }else{

                $expedicion=Expedicion::select('expediciones.id', 'archivos.folioArchivo')
                ->join('archivos', 'expediciones.id', '=', 'archivos.idExpedicion')
                ->where('expediciones.id', '=', $id)
                ->first();

            }

            return view('archivos.nuevo', ['expedicion'=>$expedicion]);

        }else{

            session()->forget('idIpes');
            session()->forget('nombreIpes');
            session()->forget('claveIpes');

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
        $archivo=array();
        $datos=array();

        try {
            
            $request->validate=[
                'folio'=>'required',
                'expedicion'=>'required'
            ];

            $archivo=new Archivo;
            $archivo->folioArchivo=$request->folio;
            $archivo->idIpes=session()->get('idIpes');
            $archivo->idExpedicion=$request->expedicion;
            $archivo->estatusArchivo='Creado';
            $archivo->save();

            if($archivo->id){

                //Crear archivo XML
                $this->crearXML($archivo, $request->expedicion);

                if(file_exists(public_path('files/xml/'.session()->get('claveIpes').'/'.$archivo->folioArchivo.'.xml'))){

                    $datos['exito']=true;
                    $datos['mensaje']='Archivo XML creado.';

                }else{

                    $archivo->delete();

                    $datos['exito']=false;
                    $datos['mensaje']='Error al creador el archivo XML. Intenta de nuevo.';

                }

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
     * @param  \App\Models\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function show($idArchivo)
    {
        try {

            $archivo=Archivo::find($idArchivo);

            return view('archivos.pago', ['archivo'=>$archivo]);
            
        } catch (\Throwable $th) {

            echo "Fatal Error: ".$th->getMessage();

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function edit($idArchivo)
    {
        try {

            $archivo=Archivo::find($idArchivo);

            return view('archivos.tramite', ['archivo'=>$archivo]);
            
        } catch (\Throwable $th) {

            echo "Fatal Error: ".$th->getMessage();

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $datos=array();
        $archivo=array();

        try {
            
            $request->validate=[
                'folio'=>'required',
                'expedicion'=>'required'
            ];

            $archivo=Archivo::where('folioArchivo', '=', $request->folio)
            ->where('idExpedicion', '=', $request->expedicion)
            ->where('idIpes', '=', session()->get('idIpes'))
            ->first();

            if(!$archivo){

                $datos['exito']=false;
                $datos['mensaje']='Archivo XML no actualizado. Intenta de nuevo.';

            }else{

                $this->crearXML($archivo, $request->expedicion);

                if(file_exists(public_path('files/xml/'.session()->get('claveIpes').'/'.$request->folio.'.xml'))){

                    $datos['exito']=true;
                    $datos['mensaje']='Archivo XML actualizado. Espera un momento.';

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
     * @param  \App\Models\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Archivo $archivo)
    {
        //
    }

    /**
     * Búsqueda y validación de folio
     * @param Request
     * @return json
     */
    public function folio(Request $request){
        $datos=array();
        $archivo=array();

        try {
            
            $request->validate=[
                'folio'=>'required'
            ];

            $archivo=Archivo::where('folioArchivo', '=', $request->folio)->first();

            if(!$archivo){

                $datos['exito']=false;
                $datos['mensaje']='Folio permitido.';

            }else{

                if($request->folio==$archivo->folioArchivo){

                    $datos['exito']=true;
                    $datos['mensaje']='Folio ya registrado. Intenta con otro.';

                }else{

                    $datos['exito']=false;
                    $datos['mensaje']='Folio permitido.';

                }

            }

        } catch (\Throwable $th) {

            $datos['exito']=true;
            $datos['mensaje']=$th->getMessage();

        }

        return response()->json($datos);
    }

    /**
     * Creación de archivo XML
     * @param Archivo
     * @return Array
     */
    public function crearXML($archivo, $idExpedicion){
        $dataXML=array();

        $xml=new XMLWriter;
        $xml->openURI(public_path('files/xml/'.session()->get('claveIpes').'/'.$archivo->folioArchivo.'.xml'));
        $xml->setIndent(true);

        $xml->startDocument('1.0', 'utf-8');

            //Inicio de XML
            $xml->startElement('TituloElectronico');
                $xml->writeAttribute('version', '1.0');
                $xml->writeAttribute('folioControl', $archivo->folioArchivo);
                $xml->writeAttribute('xmlns:xs', 'http://www.w3.org/2001/XMLSchema-instance');
                $xml->writeAttribute('xmlns', 'https://www.siged.sep.gob.mx/titulos/');
                $xml->writeAttribute('xs:schemaLocation', 'https://siged.sep.gob.mx/titulos/');
                
                //Responsables de firma
                $dataXML=$this->responsables();
                $xml->startElement('FirmaResponsables');
                    $xml->startElement('FirmaResponsable');
                        $xml->writeAttribute('nombre', mb_strtoupper($dataXML->nombreResponsable, 'utf-8'));
                        $xml->writeAttribute('primerApellido', mb_strtoupper($dataXML->apellido1Responsable, 'utf-8'));
                        $xml->writeAttribute('segundoApellido', mb_strtoupper($dataXML->apellido2Responsable, 'utf-8'));
                        $xml->writeAttribute('curp', $dataXML->curpResponsable);
                        $xml->writeAttribute('idCargo', $dataXML->cargo->id);
                        $xml->writeAttribute('cargo', mb_strtoupper( $dataXML->cargo->nombreCargo, 'utf-8'));
                        
                        if($dataXML->tituloResponsable!=''){
                            $xml->writeAttribute('abrTitulo', mb_strtoupper($dataXML->tituloResponsable, 'utf-8'));
                        }

                        $xml->writeAttribute('sello', $this->sello($idExpedicion, $archivo));
                        $xml->writeAttribute('certificadoResponsable', $this->certificado($dataXML->id));
                        $xml->writeAttribute('noCertificadoResponsable', $this->serial($dataXML->id));
                        
                    $xml->endElement();
                $xml->endElement();

                //IPES
                $dataXML=$this->ipes();
                $xml->startElement('Institucion');
                    $xml->writeAttribute('cveInstitucion', $dataXML->claveIpes);
                    $xml->writeAttribute('nombreInstitucion', mb_strtoupper($dataXML->nombreIpes, 'utf-8'));
                $xml->endElement();

                //Carrera/Plan de estudios
                $dataXML=$this->carrera($idExpedicion);
                $xml->startElement('Carrera');
                    $xml->writeAttribute('cveCarrera', $dataXML->claveCarrera);
                    $xml->writeAttribute('nombreCarrera', mb_strtoupper($dataXML->nombreCarrera, 'utf-8'));
                    $xml->writeAttribute('fechaInicio', $dataXML->fechaInicioCarrera);
                    $xml->writeAttribute('fechaTerminacion', $dataXML->fechaFinalCarrera);
                    $xml->writeAttribute('idAutorizacionReconocimiento', $dataXML->idAutoridad);
                    $xml->writeAttribute('autorizacionReconocimiento', mb_strtoupper($dataXML->autoridad->nombreAutoridad, 'utf-8'));
                    $xml->writeAttribute('numeroRvoe', $dataXML->rvoeCarrera);
                $xml->endElement();

                //Alumno egresado
                $dataXML=$this->alumno($idExpedicion);
                $xml->startElement('Profesionista');
                    $xml->writeAttribute('correoElectronico', $dataXML->emailAlumno);
                    $xml->writeAttribute('segundoApellido', mb_strtoupper($dataXML->apellido2Alumno, 'utf-8'));
                    $xml->writeAttribute('primerApellido', mb_strtoupper($dataXML->apellido1Alumno, 'utf-8'));
                    $xml->writeAttribute('nombre', mb_strtoupper($dataXML->nombreAlumno, 'utf-8'));
                    $xml->writeAttribute('curp', $dataXML->curpAlumno);
                $xml->endElement();

                //Expedicion
                $dataXML=$this->expedicion($idExpedicion);
                $xml->startElement('Expedicion');
                    $xml->writeAttribute('fechaExpedicion', $dataXML->created_at->format('Y-m-d'));
                    $xml->writeAttribute('idModalidadTitulacion', $dataXML->idTitulacion);
                    $xml->writeAttribute('modalidadTitulacion', mb_strtoupper($dataXML->titulacion->nombreTitulacion, 'utf-8'));

                    if($dataXML->fechaExamen!=''){
                        $xml->writeAttribute('fechaExamenProfesional', $dataXML->fechaExamen);
                    }

                    if($dataXML->fechaExencion!=''){
                        $xml->writeAttribute('fechaExencionExamenProfesional', $dataXML->fechaExencion);
                    }

                    $xml->writeAttribute('cumplioServicioSocial', $dataXML->servicioSocial);
                    $xml->writeAttribute('idFundamentoLegalServicioSocial', $dataXML->idFundamento);
                    $xml->writeAttribute('fundamentoLegalServicioSocial', mb_strtoupper($dataXML->fundamento->nombreFundamento, 'utf-8'));
                    $xml->writeAttribute('idEntidadFederativa', $dataXML->idEntidad);
                    $xml->writeAttribute('entidadFederativa', mb_strtoupper($dataXML->entidad->nombreEntidad, 'utf-8'));
                $xml->endElement();

                //Antecedente de alumno
                $dataXML=$this->antecedente($idExpedicion);
                $xml->startElement('Antecedente');
                    $xml->writeAttribute('institucionProcedencia', mb_strtoupper($dataXML->nombreAntecedente, 'utf-8'));
                    $xml->writeAttribute('idTipoEstudioAntecedente', $dataXML->idEstudio);
                    $xml->writeAttribute('tipoEstudioAntecedente', mb_strtoupper($dataXML->estudio->nombreEstudio, 'utf-8'));
                    $xml->writeAttribute('idEntidadFederativa', $dataXML->idEntidad);
                    $xml->writeAttribute('entidadFederativa', mb_strtoupper($dataXML->entidad->nombreEntidad, 'utf-8'));
                    $xml->writeAttribute('fechaInicio', $dataXML->fechaInicioAntecedente);
                    $xml->writeAttribute('fechaTerminacion', $dataXML->fechaFinalAntecedente);
                    
                    if($dataXML->cedulaAntecedente!=''){
                        $xml->writeAttribute('noCedula', $dataXML->cedulaAntecedente);
                    }
                $xml->endElement();
            $xml->endElement();
        $xml->fullEndElement();
    }

    /**
     * Búsqueda de datos de firmantes
     * @param session()
     * @return Array
     */
    public function responsables(){

        $responsables=Responsable::where('idIpes', '=', session()->get('idIpes'))->first();

        return $responsables;

    }

    /**
     * Búsqueda de datos de IPES
     * @param session()
     * @return Array
     */
    public function ipes(){

        $ipes=Institucion::find(session()->get('idIpes'));

        return $ipes;
    }

    /**
     * Búsqueda de datos de carrera
     * @param $idExpedicion
     * @return Array
     */
    public function carrera($idExpedicion){

        $carrera=Carrera::select('carreras.nombreCarrera', 'carreras.rvoeCarrera', 'carreras.claveCarrera', 'carreras.idAutoridad', 'alumnos.fechaInicioCarrera', 'alumnos.fechaFinalCarrera')
        ->join('alumnos', 'carreras.id', '=', 'alumnos.idCarrera')
        ->join('expediciones', 'alumnos.id', '=', 'expediciones.idAlumno')
        ->where('expediciones.id', '=', $idExpedicion)
        ->first();
        
        return $carrera;
    }

    /**
     * Búsqueda de datos de alumno egresado
     * @param $idExpedicion
     * @return Array
     */
    public function alumno($idExpedicion){

        $alumno=Alumno::select('alumnos.nombreAlumno', 'alumnos.apellido1Alumno', 'alumnos.apellido2Alumno', 'alumnos.curpAlumno', 'alumnos.emailAlumno')
        ->join('expediciones', 'alumnos.id', '=', 'expediciones.idAlumno')
        ->where('expediciones.id', '=', $idExpedicion)
        ->where('expediciones.idIpes', '=', session()->get('idIpes'))
        ->first();

        return $alumno;
    }

    /**
     * Búsqueda de datos de expedicion
     * @param $idExpedicion
     * @return Array
     */
    public function expedicion($idExpedicion){

        $expedicion=Expedicion::find($idExpedicion);

        return $expedicion;
    }

    /**
     * Búsqueda de datos de antecedente de alumno expedido
     * @param $idExpedicion
     * @return Array
     */
    public function antecedente($idExpedicion){

        $antecedente=Antecedente::select('antecedentes.nombreAntecedente', 'antecedentes.fechaInicioAntecedente', 'antecedentes.fechaFinalAntecedente', 'antecedentes.cedulaAntecedente', 'antecedentes.idEntidad', 'antecedentes.idEstudio')
        ->join('expediciones', 'antecedentes.idAlumno', '=', 'expediciones.idAlumno')
        ->where('expediciones.id', '=', $idExpedicion)
        ->first();

        return $antecedente;
    }

    /**
     * Búsqueda y recopilación de SERIAL de Responsables
     * @param Request $id
     * @return String
     */
    public function serial($idResponsable){
        $llave=array();
        $serial='';

        $llave=Llave::where('idResponsable', '=', $idResponsable)->first();

        shell_exec(public_path('openssl-1.0.2p/bin/').'openssl x509 -inform DER -in '.public_path('files/llaves/'.session()->get('claveIpes').'/'.$llave->nombreLlavePublica.' -outform PEM -out '.public_path('files/llaves/'.session()->get('claveIpes').'/'.$llave->nombreLlavePublica.'.pem')));
        $serial=shell_exec(public_path('openssl-1.0.2p/bin/openssl x509 -text -inform PEM -in '.public_path('files/llaves/'.session()->get('claveIpes').'/'.$llave->nombreLlavePublica.'.pem -noout -serial')));

        $i=strpos($serial, 'serial=');
        $serial=substr($serial, $i+7);
        $serial=trim($serial);
        $serial=mb_eregi_replace('[\n|\r|\r\n|\t]', '', $serial);

        return $serial;
    }

    /**
     * Búsqueda y recopilación de CERTIFICADO de Responsable
     * @param Request $id
     * @param String
     */
    public function certificado($idResponsable){
        $certificado='';
        $llave=array();

        $llave=Llave::where('idResponsable', '=', $idResponsable)->first();

        $certificado=shell_exec(public_path('openssl-1.0.2p/bin/').'openssl x509 -text -inform PEM -in '.public_path('files/llaves/'.session()->get('claveIpes').'/'.$llave->nombreLlavePublica.'.pem'));

        $i=strpos($certificado, 'BEGIN CERTIFICATE');
        $f=strpos($certificado, 'END CERTIFICATE');
        $certificado=substr($certificado, $i+22, (int)($f-6)-($i+22));
        $certificado=trim($certificado);
        $certificado=mb_eregi_replace('[\n|\r|\r\n|\t]', '', $certificado);
        
        return $certificado;
    }

    /**
     * Recopilación de datos para crear SELLO
     * @param Request $idExpedicion
     * @return String
     */
    public function sello($idExpedicion, $archivo){
        $sello='';
        $cadena='';
        $firma='';

        $responsables=$this->responsables();
        $ipes=$this->ipes();
        $carrera=$this->carrera($idExpedicion);
        $alumno=$this->alumno($idExpedicion);
        $expedicion=$this->expedicion($idExpedicion);
        $antecedente=$this->antecedente($idExpedicion);
        $firma=$this->firma($responsables->id);

        $cadena.='||1.0|'.$archivo->folioArchivo.'|'.mb_strtoupper($responsables->curpResponsable, 'utf-8').'|'.$responsables->idCargo.'|'.mb_strtoupper($responsables->cargo->nombreCargo, 'utf-8').'|'.mb_strtoupper($responsables->tituloResponsable, 'utf-8').'|';
        $cadena.=$ipes->claveIpes.'|'.mb_strtoupper($ipes->nombreIpes, 'utf-8').'|';
        $cadena.=$carrera->claveCarrera.'|'.mb_strtoupper($carrera->nombreCarrera, 'utf-8').'|'.$carrera->fechaInicioCarrera.'|'.$carrera->fechaFinalCarrera.'|'.$carrera->idAutoridad.'|'.mb_strtoupper($carrera->autoridad->nombreAutoridad, 'utf-8').'|'.$carrera->rvoeCarrera.'|';
        $cadena.=mb_strtoupper($alumno->curpAlumno, 'utf-8').'|'.mb_strtoupper($alumno->nombreAlumno, 'utf-8').'|'.mb_strtoupper($alumno->apellido1Alumno, 'utf-8').'|'.mb_strtoupper($alumno->apellido2Alumno, 'utf-8').'|'.$alumno->emailAlumno.'|';
        $cadena.=$expedicion->created_at->format('Y-m-d').'|'.$expedicion->idTitulacion.'|'.mb_strtoupper($expedicion->titulacion->nombreTitulacion, 'utf-8').'|'.$expedicion->fechaExamen.'|'.$expedicion->fechaExencion.'|'.$expedicion->servicioSocial.'|'.$expedicion->idFundamento.'|'.mb_strtoupper($expedicion->fundamento->nombreFundamento, 'utf-8').'|'.$expedicion->idEntidad.'|'.mb_strtoupper($expedicion->entidad->nombreEntidad, 'utf-8').'|';
        $cadena.=mb_strtoupper($antecedente->nombreAntecedente, 'utf-8').'|'.$antecedente->idEstudio.'|'.mb_strtoupper($antecedente->estudio->nombreEstudio, 'utf-8').'|'.$antecedente->idEntidad.'|'.mb_strtoupper($antecedente->entidad->nombreEntidad, 'utf-8').'|'.$antecedente->fechaInicioAntecedente.'|'.$antecedente->fechaFinalAntecedente.'|'.$antecedente->cedulaAntecedente.'||'; 

        //print_r('Cadena: '.$cadena);

        openssl_sign($cadena, $sello, $firma);
        $sello=base64_encode($sello);

        return $sello;
    }

    /**
     * Búsqueda y recopilación de E.FIRMA
     * @param Request $idResponsable
     * @return String
     */
    public function firma($idResponsable){
        $llave=array();
        $firma='';

        $llave=Llave::where('idResponsable', '=', $idResponsable)->first();

        //Extracción
        shell_exec(public_path('openssl-1.0.2p/bin/').'openssl pkcs8 -inform DER -in '.public_path('files/llaves/'.session()->get('claveIpes').'/'.$llave->nombreLlavePrivada.' -outform PEM -out '.public_path('files/llaves/'.session()->get('claveIpes').'/'.$llave->nombreLlavePrivada.'.pem -passin pass:'.Crypt::decrypt($llave->passLlavePrivada))));
        $firma=(string)shell_exec(public_path('openssl-1.0.2p/bin/').'openssl rsa -inform PEM -outform PEM -in '.public_path('files/llaves/'.session()->get('claveIpes').'/').$llave->nombreLlavePrivada.'.pem');
        
        return $firma;
    }

    /**
     * Cobro de Archivo XML
     * @param Request $request
     * @return json
     */
    public function pagar(Request $request){
        try {
            
            $request->validate=[
                'id' => 'required|integer',
                'precio' => 'required|min:4|max:4|integer',
                'tarjeta' => 'required|min:16|max:16',
                'mes' => 'required|integer|min:2|max:2',
                'ano' => 'required|integer|min:2|max:2',
                'cvc' => 'required|integer',
                'descripcion' => 'required'
            ];

            $token = $this->stripe->tokens->create([
                'card'=>[
                    'number' => $request->tarjeta,
                    'exp_month' => $request->mes,
                    'exp_year' => $request->ano,
                    'cvc' => $request->cvc
                ]
            ]);

            $charge = $this->stripe->charges->create([
                "amount" => $request->precio.'00',
                "currency" => 'mxn',
                "source" => $token,
                "description" => $request->descripcion." ID_ARCHIVO: ".$request->id,
            ]);

            if($charge->paid==true){

                $archivo=Archivo::find($request->id);

                if($request->descripcion=='Pago de archivo XML'){

                    $archivo->estatusArchivo='Pagado';

                }else{

                    $archivo->estatusArchivo='Tramitado';

                }
                
                $archivo->save();

                if($archivo->id){

                    $datos['exito']=true;
                    $datos['mensaje']='Pago Exitoso. Espera un momento.';

                }

            }

        } catch (\Throwable $th) {

            $datos['exito']=false;
            $datos['mensaje']=$th->getMessage();

        }

        return response()->json($datos);
    }
}
