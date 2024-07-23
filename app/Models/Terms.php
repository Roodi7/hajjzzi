<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terms extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
    ];
    public function accommodations()
    {
        return $this->belongsToMany(Accommodations::class, 'accomdation_terms', 'term_id', 'accommodation_id');
    }
}
