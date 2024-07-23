<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccomdationFeature extends Model
{
    use HasFactory;
    protected $table = 'accomdation_features';
    protected $fillable = [
        'accommodation_id',
        'feature_id',
    ];
}
