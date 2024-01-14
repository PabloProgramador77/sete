<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Institucion;
use App\Models\EntidadFederativa;
use App\Models\Estudio;
use App\Models\Alumno;

class Antecedente extends Model
{
    use HasFactory;

    protected $table='antecedentes';

    protected $fillable=[
        'nombreAntecedente',
        'fechaInicioAntecedente',
        'fechaFinalAntecedente',
        'cedulaAntecedente',
        'idIpes',
        'idEntidad',
        'idEstudio',
        'idAlumno'
    ];

    public function ipes(){
        return $this->hasOne(Institucion::class, 'id', 'idIpes');
    }

    public function entidad(){
        return $this->hasOne(EntidadFederativa::class, 'id', 'idEntidad');
    }

    public function estudio(){
        return $this->hasOne(Estudio::class, 'id', 'idEstudio');
    }

    public function alumno(){
        return $this->hasOne(Alumno::class, 'id', 'idAlumno');
    }

}
