<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assistant extends User
{
    /** @use HasFactory<\Database\Factories\AssistantFactory> */
    use HasFactory;

    protected $fillable = ['nom_asst_dep', 'departement_id', 'date_affectation'];

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }
}
