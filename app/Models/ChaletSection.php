<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChaletSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'accommodation_id',
        'numberOfRooms',
        'pricePerNight',
        'numberOfStars',
        'description',
        'latitude',
        'longitude',
        'bookingConditions',
        'cancellingConditions',
    ];



    public function accommodation()
    {
        return $this->belongsTo(Accommodations::class, 'accommodation_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'entity_id')->where('entity_type', 'chalet_section');
    }

    public function images()
    {
        return $this->hasMany(Attachments::class, 'entity_id')->where('entity_type', 'chalet_section');
    }

    public function video()
    {
        return $this->hasMany(Video::class, 'chalet_section_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class)->where('status', '!=', 'rejected');
    }
    public function features()
    {
        return $this->belongsToMany(Features::class, 'chalet_section_features', 'chalet_section_id', 'feature_id');
    }

}


