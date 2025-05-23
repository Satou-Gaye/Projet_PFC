<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DateMorte extends Model
{
    /** @use HasFactory<\Database\Factories\DateMorteFactory> */
    use HasFactory;

    protected $table = 'dates_morte';
    protected $fillable =[
        'id',
        'date_debut',
        'date_fin',
        'type',
        'annee_academique_id'
    ];
    protected $casts =[
        'date_debut' =='date',
        'date_fin' == 'date',
    ];

    public function anneeAcademique(): BelongsTo {
        return $this->belongsTo(AnneeAcademique::class);
    }

    public function verifitDateMorte($date) {
        return $date >= $this->date_debut && $date <= $this->date_fin;
    }

}
