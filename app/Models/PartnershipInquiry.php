<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnershipInquiry extends Model
{
    protected $fillable = [
        'name',
        'organization',
        'email',
        'phone',
        'service',
        'message',
        'status',
    ];
}
