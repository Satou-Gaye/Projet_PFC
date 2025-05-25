<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Relations\BelongsTo;

class Periode_academiques extends Model
{
    /** @use HasFactory<\Database\Factories\AcademicPeriodeFactory> */
    use HasFactory;

    protected $fillable = [
        'date_debut',
        'date_fin',
        'type',
        'couleur',
        'type',
        'semaine',
        'niveau_id',
        'annee_academique_id'
    ];

    protected $casts = [
        'date_debut'=> 'date',
        'date_fib' => 'date'
    ];

    public function niveau()
    {
        return $this->belongsTo(Niveaux::class);
    }

    public function anneeAcademique()
    {
        return $this->belongsTo(Annee_academique::class);
    }

}
