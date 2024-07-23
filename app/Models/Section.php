<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = [
        'hotels_description',
        'hotels_image',
        'chalets_description',
        'chalets_image',
        'halls_description',
        'halls_image',
        'appartments_description',
        'appartments_image',
    ];
}
