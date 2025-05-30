<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UE extends Model
{
    /** @use HasFactory<\Database\Factories\UeFactory> */
    use HasFactory;
    protected $table ='ues';
    protected $fillable = ['codeUE', 'Element_Constitutif', 'VHT', 'Coef', 'Credit'];
    protected $primaryKey = 'codeUE';
    protected $typeKey = 'string';
    public $incrementing = false;

    public function ecs(): HasMany {
        return $this->hasMany(EC::class);
    }

    public function niveaux(): BelongsToMany {
        return $this->BelongsToMany(Niveau::class, 'niveau_ue');
    }

    public function semestres(): BelongsToMany {
        return $this->BelongsToMany(Semestre::class, 'semestre_ue');
    }


}
