<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Expedicion;
use App\Models\Institucion;

class Archivo extends Model
{
    use HasFactory;

    protected $table='archivos';

    protected $fillable=[
        'folioArchivo', 'idIpes', 'idExpedicion',
        'estatusArchivo'
    ];

    //Expedicion
    public function expedicion(){
        return $this->hasOne(Expedicion::class, 'id', 'idExpedicion');
    }

    //IPES
    public function ipes(){
        return $this->hasOne(Institucion::class, 'id', 'idIpes');
    }
}
