<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntidadFederativa extends Model
{
    use HasFactory;

    protected $table='entidad_federativas';

    protected $filla=[
        'nombreEntidad'
    ];
}
