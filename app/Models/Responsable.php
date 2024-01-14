<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    use HasFactory;

    protected $table='responsables';

    protected $fillable=[
        'nombreResponsable', 'apellido1Responsable', 'apellido2Responsable', 
        'curpResponsable', 'tituloResponsable', 'idIpes', 'idCargo'
    ];

    public function ipes(){
        return $this->hasOne(Institucion::class, 'id', 'idIpes');
    }

    public function cargo(){
        return $this->hasOne(Cargo::class, 'id', 'idCargo');
    }
}
