<?php

namespace App\Support;

use Illuminate\Support\Str;

class Slug
{
    public static function unique(string $value, string $table, ?int $ignoreId = null, string $column = 'slug'): string
    {
        $base = Str::slug($value);
        $base = $base !== '' ? $base : 'item';
        $slug = $base;
        $i = 2;

        while (
            \Illuminate\Support\Facades\DB::table($table)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->where($column, $slug)
                ->exists()
        ) {
            $slug = $base.'-'.$i;
            $i++;
        }

        return $slug;
    }
}
