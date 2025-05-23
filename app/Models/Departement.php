<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Departement extends Model
{
    /** @use HasFactory<\Database\Factories\DepartementFactory> */
    use HasFactory;
    
    protected $fillable = ['departement_id', 'nomDpt'];

    public function niveaux(): HasMany
    {
        return $this->hasMany(Niveau::class);

    }

    public function chefDepartement()
    {
        return $this->hasOne(ChefDeDepartement::class, 'departement_id');
    }

    public function assistantDepartement()
    {
        return $this->hasOne(Assistant::class, 'departement_id');
    }

    public function chefFilieres()
    {
        return $this->hasMany(ChefDeFilliere::class, 'departement_id');
    }
}
