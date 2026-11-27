<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    protected $fillable = [
        'group_id',
        'name',
        'slug',
        'bio',
        'sort_order',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function initials(): string
    {
        $parts = preg_split('/\s+/', trim($this->name)) ?: [];

        if (count($parts) < 2) {
            return mb_strtoupper(mb_substr($parts[0] ?? 'B', 0, 2));
        }

        return mb_strtoupper(mb_substr($parts[0], 0, 1).mb_substr($parts[count($parts) - 1], 0, 1));
    }

    public function photoUrl(): ?string
    {
        foreach (['jpg', 'jpeg', 'png', 'webp'] as $ext) {
            $path = "images/members/{$this->slug}.{$ext}";
            if (is_file(public_path($path))) {
                return asset($path);
            }
        }

        return null;
    }
}
