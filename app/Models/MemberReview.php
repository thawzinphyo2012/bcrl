<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberReview extends Model
{
    protected $fillable = [
        'name',
        'group_name',
        'quote',
    ];
}
