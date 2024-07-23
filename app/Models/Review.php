<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'entity_type',
        'entity_id',
        'rating',
        'comment',
    ];

   public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function accommodation()
    {
        return $this->belongsTo(Accommodations::class, 'entity_id')->where('entity_type', 'accommodation');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'entity_id')->where('entity_type', 'room');
    }

    public function chaletSection()
    {
        return $this->belongsTo(ChaletSection::class, 'entity_id')->where('entity_type', 'chalet_section');
    }
}
