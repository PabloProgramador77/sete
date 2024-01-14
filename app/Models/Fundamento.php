<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fundamento extends Model
{
    use HasFactory;

    protected $table='fundamentos';

    protected $fillable=[
        'nombreFundamento'
    ];
}
