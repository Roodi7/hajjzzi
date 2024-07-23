<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSectionInfo extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'images'];

    public function images()
    {
        return $this->hasMany(Attachments::class, 'entity_id')->where('entity_type', 'footer_section');
    }

}
