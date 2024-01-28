<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coche extends Model
{
    use HasFactory;
    protected $table = 'coches';
    protected $primaryKey = 'Matricula';
    public $incrementing = false;
    public $timestamps = false;
}
