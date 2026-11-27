<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsPost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'excerpt',
        'body',
        'youtube_url',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function paragraphs(): array
    {
        $chunks = preg_split("/\r?\n\s*\r?\n/", trim($this->body)) ?: [];

        return array_values(array_filter(array_map(fn ($paragraph) => trim($paragraph), $chunks)));
    }

    public function youtubeId(): ?string
    {
        if (! $this->youtube_url) {
            return null;
        }

        if (preg_match('~(?:youtu\.be/|youtube\.com/(?:watch\?v=|embed/|shorts/))([A-Za-z0-9_-]{11})~', $this->youtube_url, $matches)) {
            return $matches[1];
        }

        return null;
    }
}
