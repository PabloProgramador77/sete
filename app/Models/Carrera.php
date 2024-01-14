<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Autoridad;
use App\Models\Institucion;

class Carrera extends Model
{
    use HasFactory;

    protected $table='carreras';

    protected $fillable=[
        'nombreCarrera', 'rvoeCarrera', 'claveCarrera',
        'idAutoridad', 'idIpes'
    ];

    public function autoridad(){
        return $this->hasOne(Autoridad::class, 'id', 'idAutoridad');
    }

    public function ipes(){
        return $this->hasOne(Institucion::class, 'id', 'idIpes');
    }
}
