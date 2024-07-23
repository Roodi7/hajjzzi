<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachments extends Model
{
    use HasFactory;
    protected $fillable = [
        'entity_type',
        'entity_id',
        'attachment_name',
        'attachment_path',
    ];


}
