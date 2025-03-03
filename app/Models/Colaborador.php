<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    use HasFactory;

    protected $table = "colaborador";
    //

    protected $fillable = [
        'name',
        'departamento_id',
        'setor_id',
    ];
}
