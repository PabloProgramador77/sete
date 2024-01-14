<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Alumno;
use App\Models\EntidadFederativa;
use App\Models\Fundamento;
use App\Models\Titulacion;
use App\Models\Institucion;

class Expedicion extends Model
{
    use HasFactory;

    protected $table='expediciones';

    protected $fillable=[
        'servicioSocial', 'idTitulacion', 'fechaExamen',
        'fechaExencion', 'idFundamento', 'idEntidad',
        'idAlumno', 'idIpes'
    ];

    //Alumno
    public function alumno(){
        return $this->hasOne(Alumno::class, 'id', 'idAlumno');
    }

    //Modalidad de titulación
    public function titulacion(){
        return $this->hasOne(Titulacion::class, 'id', 'idTitulacion');
    }

    //Fundamento legal de servicio social
    public function fundamento(){
        return $this->hasOne(Fundamento::class, 'id', 'idFundamento');
    }

    //Entidad federativa
    public function entidad(){
        return $this->hasOne(EntidadFederativa::class, 'id', 'idEntidad');
    }

    //IPES emisora
    public function ipes(){
        return $this->hasOne(Institucion::class, 'id', 'idIpes');
    }
}
