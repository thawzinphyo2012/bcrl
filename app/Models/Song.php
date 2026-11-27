<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Song extends Model
{
    protected $fillable = [
        'group_id',
        'title',
        'slug',
        'listen_url',
        'description',
        'songwriter',
        'producer',
        'recording',
        'released_on',
        'is_highlight',
        'highlight_position',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'released_on' => 'date',
            'is_highlight' => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function posterUrl(): ?string
    {
        foreach (['jpg', 'jpeg', 'png', 'webp'] as $ext) {
            $path = "images/songs/{$this->slug}.{$ext}";
            if (is_file(public_path($path))) {
                return asset($path);
            }
        }

        return null;
    }

    public function audioUrl(): ?string
    {
        $path = "audio/{$this->slug}.mp3";

        return is_file(public_path($path)) ? asset($path) : null;
    }

    public function credits(): array
    {
        return [
            'Songwriter' => $this->songwriter,
            'Producer' => $this->producer,
            'Recording' => $this->recording,
        ];
    }
}
