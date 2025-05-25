<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;



class Semestres extends Model
{
    /** @use HasFactory<\Database\Factories\SemestreFactory> */
    use HasFactory;

    protected $fillable = ['id', 'nom_semestre', 'annee_academique_id', 'option_id', 'niveau_id'];
    //protected $primaryKey = 'id_semestre';
    //protected $keyType = 'integer';
    //public $incrementing = true;
    public function anneeAcademique(): BelongsTo
    {
        return $this->belongsTo(Annee_academique::class);
    }

    public function ues(): BelongsToMany {
        return $this->belongsToMany(Ues::class, 'semestre_ue');
    }

    public function niveaux(): BelongsToMany {
        return $this->belongsTo(Niveaux::class, 'semestre_niveau');
    }

    public function option()
    {
        return $this->belongsTo(Options::class);
    }

    

}
