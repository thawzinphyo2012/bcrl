<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    public static function getValue(string $key, mixed $default = null): mixed
    {
        $raw = Cache::rememberForever("setting.{$key}", function () use ($key) {
            return static::query()->where('key', $key)->value('value');
        });

        if ($raw === null) {
            return $default;
        }

        $decoded = json_decode($raw, true);

        return json_last_error() === JSON_ERROR_NONE ? $decoded : $raw;
    }

    public static function putValue(string $key, mixed $value): void
    {
        $stored = is_array($value) || is_bool($value) || is_int($value)
            ? json_encode($value, JSON_UNESCAPED_UNICODE)
            : (string) $value;

        static::query()->updateOrCreate(
            ['key' => $key],
            ['value' => $stored],
        );

        Cache::forget("setting.{$key}");
        Cache::forget('settings.all');
    }

    public static function clearCache(): void
    {
        Cache::forget('settings.all');

        foreach (static::query()->pluck('key') as $key) {
            Cache::forget("setting.{$key}");
        }
    }
}
