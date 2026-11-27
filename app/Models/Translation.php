<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Translation extends Model
{
    protected $fillable = [
        'locale',
        'group',
        'key',
        'value',
    ];

    public static function clearCache(?string $locale = null): void
    {
        if ($locale) {
            Cache::forget("translations.{$locale}.site");

            return;
        }

        foreach (['en', 'my', 'zh'] as $code) {
            Cache::forget("translations.{$code}.site");
        }
    }
}
