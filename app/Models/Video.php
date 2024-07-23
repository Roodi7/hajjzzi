<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable = ['url', 'room_id', 'chalet_section_id', 'accommodation_id'];

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
}
