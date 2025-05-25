<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Chef_de_departements extends User
{
    /** @use HasFactory<\Database\Factories\ChefDeDepartementFactory> */
    use HasFactory;

    protected $fillable = ['nom_dept',  'departement_id', 'date_nomination'];

    public function departement(): BelongsTo
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }
}
