<?php

namespace App\Support;

use Illuminate\Support\Arr;

class LangTree
{
    public static function flatten(array $items, string $prefix = ''): array
    {
        $result = [];

        foreach ($items as $key => $value) {
            $path = $prefix === '' ? (string) $key : $prefix.'.'.$key;

            if (is_array($value)) {
                $result += self::flatten($value, $path);
            } else {
                $result[$path] = (string) $value;
            }
        }

        return $result;
    }

    public static function nest(array $flat): array
    {
        return Arr::undot($flat);
    }
}
