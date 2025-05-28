<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    /** @use HasFactory<\Database\Factories\OptionFactory> */
    use HasFactory;
    protected $fillable = ['nom_option','semestre_id'];

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }

    // Une option a plusieurs semestres
    public function semestres()
    {
        return $this->hasMany(Semestre::class);
    }
}
