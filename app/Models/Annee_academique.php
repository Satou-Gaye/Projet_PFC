<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquant\HasMany;

class AnneeAcademique extends Model
{
    /** @use HasFactory<\Database\Factories\AnneeAcademiqueFactory> */
    use HasFactory;

    protected $table = 'annee_academiques';
    protected $fillable = ['id', 'date_debut', 'date_fin', 'demarrer'];
    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'demarrer' => 'boolean',
    ];
    public $incrementing = false;
    protected $keyType = 'string';

    public function semestres(): HasMany
    {
        return $this->HasMany(Semestre::class);
    }

    public function dateMortes(): HasMnay
    {
        return $this->HasMany(DateMorte::class);
    }

    public function estPlanifiable($date)
    {
        //verifier si la date est planifiable
        if($date < $this->date_debut || $date > $date_fin){
            return false;
        }

        //verifier si la date est une date morte 
        // la fonction parcours l'ensemble des date morte pour savoir si une date considere appartient dans cette intervalle
        foreach ($this->dateMortes as $dateMorte){
            if($date >= $dateMorte->date_debut && $date <= $dateMorte->date_fin){
                return false;
            }
        }
        return false;
    }


}
