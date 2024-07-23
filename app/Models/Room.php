<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_number',
        'cancellingConditions',
        'bookingConditions',
        'bedsNumber',
        'roomsNumber',
        'floor',
        'price',
        'description',
        'category',
        'accommodation_id',
        'is_available',

    ];


    public function accommodation()
    {
        return $this->belongsTo(Accommodations::class, 'accommodation_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'entity_id')->where('entity_type', 'room');
    }

    public function images()
    {
        return $this->hasMany(Attachments::class, 'entity_id')->where('entity_type', 'room');
    }

    public function video()
    {
        return $this->hasMany(Video::class, 'room_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class)->where('status', '!=', 'rejected')->whereDate('end_date', '>=', now());
    }

    public function getReservedDates()
    {
        $reservations = $this->reservations()->get(['start_date', 'end_date']);
        $reservedDates = [];

        foreach ($reservations as $reservation) {
            $reservedDates[] = [
                'start_date' => $reservation->start_date,
                'end_date' => $reservation->end_date,
            ];
        }

        return $reservedDates;
    }

    public function features()
    {
        return $this->belongsToMany(Features::class, 'room_features', 'room_id', 'feature_id');
    }

}
