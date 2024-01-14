<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Llave extends Model
{
    use HasFactory;

    protected $table='llaves';

    protected $fillable=[
        'nombreLlavePublica',
        'nombreLlavePrivada',
        'passLlavePrivada',
        'idResponsable',
        'idIpes'
    ];

    public function responsable(){
        return $this->hasOne(Responsable::class, 'id', 'idResponsable');
    }

    public function ipes(){
        return $this->hasOne(Institucion::class, 'id', 'idIpes');
    }
}
