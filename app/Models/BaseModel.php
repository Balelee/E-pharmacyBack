<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class BaseModel extends Model
{
    use HasFactory;

    public static function random(): Model
    {
        return static::inRandomOrder()->first();
    }

    public static function validationRules(): array
    {
        return [];
    }

    public static function getValidationRule(string $name): array
    {
        return Arr::get(static::validationRules(), $name, []);
    }

    public static function options(string $valueName = 'name'): array
    {
        return static::get()->options($valueName);
    }

    /**
     * basic recovery request: ordered by recent addition
     */
    public static function baseGetQuery(): Builder
    {
        return static::query()->orderBy('id', 'desc');
    }
}
