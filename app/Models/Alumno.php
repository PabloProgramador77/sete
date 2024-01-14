<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Institucion;
use App\Models\Carrera;

class Alumno extends Model
{
    use HasFactory;

    protected $table='alumnos';

    protected $fillable=[
        'nombreAlumno',
        'apellido1Alumno',
        'apellido2Alumno',
        'curpAlumno',
        'emailAlumno',
        'idIpes',
        'dCarrera'
    ];

    public function ipes(){
        return $this->hasOne(Institucion::class, 'id', 'idIpes');
    }

    public function carrera(){
        return $this->hasOne(Carrera::class, 'id', 'idCarrera');
    }
}
