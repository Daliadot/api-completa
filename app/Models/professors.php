<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class professors extends Model
{
    protected $fillable = [
        'nome',
        'disciplina',
        'idade',
    ];
}
