<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class ChefDeFilliere extends User
{
    /** @use HasFactory<\Database\Factories\ChefDeFilliereFactory> */
    use HasFactory;

    protected $fillable = ['nom_filliere', 'departement_id', 'date_nomination'];

    public function departement(): BlongsTo
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }

}
