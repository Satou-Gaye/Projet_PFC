<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatesExtremes extends Model
{
    /** @use HasFactory<\Database\Factories\DateExtremeFactory> */
    use HasFactory;

    protected $table = 'dates_extremes';
    protected $fillable = ['date_debut', 'date_fin', 'debut_examen', 'semestre_id'];
    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];
}
