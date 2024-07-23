<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChaletSectionFeatures extends Model
{
    use HasFactory;
    protected $fillable = [
        'chalet_section_id',
        'feature_id'
    ];
}
