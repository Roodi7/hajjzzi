<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Accommodations extends Model
{
    use HasFactory;


    protected $fillable = [
        'type',
        'name',
        'location',
        'short_description',
        'description',
        'capacity',
        'price_per_night',
        'availability',
        'city_id',
        'manager_id',
        'bookingConditions',
        'cancellingConditions',
    ];
    public function scopeHotels(Builder $query)
    {
        return $query->where('type', 'hotel');
    }
    public function scopeChalets(Builder $query)
    {
        return $query->where('type', 'chalet');
    }


    public function scopeHalls(Builder $query)
    {
        return $query->where('type', 'hall');
    }

    public function scopeAppartments(Builder $query)
    {
        return $query->where('type', 'appartment');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function images()
    {
        return $this->hasMany(Attachments::class, 'entity_id')->where('entity_type', 'accomodation');
    }
    public function attachments()
    {
        return $this->hasMany(Attachments::class, 'entity_id')->where('entity_type', 'accomodation');
    }
    public function features()
    {
        return $this->belongsToMany(Features::class, 'accomdation_features', 'accommodation_id', 'feature_id');
    }

    public function terms()
    {
        return $this->belongsToMany(Terms::class, 'accomdation_terms', 'accommodation_id', 'term_id');
    }
    public function BookingConditions()
    {
        return $this->belongsToMany(Terms::class, 'accomdation_terms', 'accommodation_id', 'term_id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'accommodation_id');
    }
    public function availableRooms()
    {
        return $this->hasMany(Room::class, 'accommodation_id')->where('is_available', 1);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'entity_id')->where('entity_type', 'accommodation');
    }

    public function numberOfRooms()
    {
        return $this->rooms()->count();
    }


    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }


    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'accommodation_id')->whereNull(['room_id','chalet_section_id'])->whereDate('end_date', '>=', now());
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

    public function video()
    {
        return $this->hasMany(Video::class, 'accommodation_id');
    }



    public function ChaletSections()
    {
        return $this->hasMany(ChaletSection::class, 'accommodation_id');
    }


}
