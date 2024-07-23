<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Attachments;
use App\Models\Accommodations;

class City extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'city_name',
        'details',
        'description',
        'notes'
    ];

    public function images()
    {
        return $this->hasMany(Attachments::class, 'entity_id')->where('entity_type', 'city');
    }

    public function attachments()
    {
        return $this->hasMany(Attachments::class, 'entity_id')->where('entity_type', 'city');
    }
    public function accommodations()
    {
        return $this->hasMany(Accommodations::class);
    }
}
