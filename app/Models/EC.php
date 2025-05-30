<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class EC extends Model
{
    /** @use HasFactory<\Database\Factories\EcFactory> */
    use HasFactory;

    protected $table = 'ecs';
    protected $fillable =[
        'codeEC',
        'intitule',
        'statut',
        'nbHeureEC',
        'nbHeureTD',
        'nbTotalHeure',
        'nbHeureSuivi',
        'codeUE',
        'date_debut'
    ];

    protected $primaryKey = 'codeEC';
    protected $typeKey = 'string';
    public $incrementing = false;

    public function ue(): BelongsTo {
        return $this->belongsTo(UE::class);
    }

    public function semestre(){
    return $this->belongsTo(Semestre::class);
    }

    public function niveau(){
    return $this->semestre->niveau();  
    }

   
}
 
