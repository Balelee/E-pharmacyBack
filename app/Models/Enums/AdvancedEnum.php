<?php

namespace App\Models\Enums;

use Illuminate\Support\Arr;
use App\Models\Enums\AdvancedEnumInterface;

trait AdvancedEnum
{
    public function label(): string
    {
        return ucfirst($this->value);
    }

    public function equals(AdvancedEnumInterface ...$enums): bool
    {
        return in_array($this, $enums);
    }

    public static function values(): array
    {
        return array_map(fn (AdvancedEnumInterface $enum): string => $enum->value, self::cases());
    }

    public static function labels(): array
    {
        return array_map(fn (AdvancedEnumInterface $enum): string => $enum->label(), self::cases());
    }

    public static function options(): array
    {
        return array_combine(
            self::values(),
            self::labels(),
        );
    }

    public static function selectOptions(): array
    {
        return array_map(
            fn ($value, $label) => ['value' => $value, 'label' => $label],
            self::values(),
            self::labels(),
        );
    }

    public static function random(): self
    {
        return Arr::random(self::cases());
    }
}
