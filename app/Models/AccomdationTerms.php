<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccomdationTerms extends Model
{
    use HasFactory;

    protected $fillable = [
        'accommodation_id',
        'term_id',
    ];

    public function accommodation()
    {
        return $this->belongsTo(Accommodations::class);

    }
}
