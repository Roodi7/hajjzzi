<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'accommodation_id',
        'room_id',
        'chalet_section_id',
        'name',
        'phone_number',
        'start_date',
        'end_date',
        'notes',
        'status',
        'pay_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function accommodation()
    {
        return $this->belongsTo(Accommodations::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function chaletSection()
    {
        return $this->belongsTo(ChaletSection::class);
    }


    public function calculateTotalPrice()
    {
        $start_date = \Carbon\Carbon::parse($this->start_date);
        $end_date = \Carbon\Carbon::parse($this->end_date);
        $days = $start_date->diffInDays($end_date) + 1;

        $price_per_day = $this->room ? $this->room->price : $this->accommodation->price;

        return $days * $price_per_day;
    }
}
