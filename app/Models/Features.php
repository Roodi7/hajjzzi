<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Features extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'rating',
        'description',
        'notes'
    ];

    public function attachments()
    {
        return $this->hasMany(Attachments::class, 'entity_id')->where('entity_type', 'feature');
    }
    public function accommodations()
    {
        return $this->belongsToMany(Accommodations::class, 'accomdation_features', 'feature_id', 'accommodation_id');
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_features', 'feature_id', 'room_id');
    }

    public function chalet_sections()
    {
        return $this->belongsToMany(ChaletSection::class, 'chalet_section_features', 'feature_id', 'chalet_section_id');
    }
}
