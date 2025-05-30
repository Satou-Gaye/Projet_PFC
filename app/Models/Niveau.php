<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Niveau extends Model
{
    /** @use HasFactory<\Database\Factories\NiveauFactory> */
    use HasFactory;

    protected $fillable =['id', 'nom_niveau', 'id_departement'];
    //protected $primaryKey = 'id_niveau';
    //protected $typeKey = 'interger';
    //public $incrementing = true;


    public function departement(): BelongsTo {
        return $this->belongsTo(Departement::class);
    }

    public function ues(): BelongsToMany {
        return $this->belongsToMany(Ue::class, 'niveau_ue');

    }

    public function options(): BelongsToMany {
        return $this->belogsToMany(Option::class, 'niveau_option');

    }

    public function semestres(): BelongsToMany {
        return $this->belongsToMany(Semestre::class, 'semestre_niveau');
    }

}
