<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditionApplication extends Model
{
    protected $fillable = [
        'full_name',
        'age',
        'city',
        'contact',
        'email',
        'interest',
        'experience',
        'why',
        'demo_url',
        'status',
    ];
}
