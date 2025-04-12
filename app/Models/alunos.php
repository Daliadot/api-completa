<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class alunos extends Model
{
    protected $fillable = [
        'nome',
        'curso',
        'idade',
    ];
}
