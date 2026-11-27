<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'concept',
        'genre',
        'summary',
        'accent',
        'accent_ink',
        'telegram_url',
        'sort_order',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function members(): HasMany
    {
        return $this->hasMany(Member::class)->orderBy('sort_order');
    }

    public function songs(): HasMany
    {
        return $this->hasMany(Song::class)->orderByDesc('released_on');
    }

    public function bandStyle(): string
    {
        $bg = preg_match('/^#[0-9A-Fa-f]{6}$/', $this->accent) ? $this->accent : '#1a120c';
        $ink = preg_match('/^#[0-9A-Fa-f]{6}$/', $this->accent_ink) ? $this->accent_ink : '#fbf6ee';

        return "--band: {$bg}; --band-ink: {$ink};";
    }

    public function logoUrl(): ?string
    {
        foreach (['svg', 'png', 'webp', 'jpg', 'jpeg'] as $ext) {
            $path = "images/groups/{$this->slug}.{$ext}";
            if (is_file(public_path($path))) {
                return asset($path);
            }
        }

        return null;
    }
}
