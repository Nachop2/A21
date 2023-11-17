<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo',
        'materia',
        'h_semanales',
        'h_totales',
        'turno',
        'aula',
        'user_id',
        'especialidad_id',
        'estudio_id'
    ];
}
