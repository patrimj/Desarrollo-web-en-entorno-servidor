<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profesor;

class Parte extends Model
{
    use HasFactory;

    function partesRecibidos(){
        return $this->belongsTo(Profesor::class, 'idprofesor', 'id');
    }
}
