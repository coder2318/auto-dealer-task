<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class ArrayStringCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get($model, string $key, $value, array $attributes): array
    {
        if (isset($attributes[$key]) && $attributes[$key] !== '{}') {
            $array = explode(',', str_replace(['{', '}'], '', $attributes[$key]));
            return array_map('intval', $array);
        }
        return [];
    }

    /**
     * Prepare the given value for storage.
     *
     * @param array<string, mixed> $attributes
     */
    public function set($model, string $key, $value, array $attributes): array
    {
        $ids_string = implode(',', $value);
        return [
            $key => "{" . $ids_string . "}",
        ];
    }
}
