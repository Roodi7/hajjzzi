<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'manage_users',
        'manage_mainpage',
        'manage_mails',
        'user_id',
        'term_delete',
        'term_edit',
        'term_create',
        'term_index',
        'feature_delete',
        'feature_edit',
        'feature_create',
        'feature_index',
        'accomodation_delete',
        'accomodation_edit',
        'accomodation_create',
        'accomodation_index',
        'city_delete',
        'city_edit',
        'city_create',
        'city_index',
    ];

    public function user()
    {
        $this->belongsTo(User::class, 'user_id');
    }
}
