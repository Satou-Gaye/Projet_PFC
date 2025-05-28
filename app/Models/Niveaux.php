<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveaux extends Model
{
    /** @use HasFactory<\Database\Factories\NiveauxFactory> */
    use HasFactory;

    protected $table = 'niveaux';

    protected $fillable = ['nom_niveau', 'codeUE', 'id_semestre'  ];
}
