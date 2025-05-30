<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Date_extreme extends Model
{
    /** @use HasFactory<\Database\Factories\DateExtremeFactory> */
    use HasFactory;

    protected $table = 'dates_extremes';
    protected $fillable = ['date_debut', 'date_fin'];
    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];
}
