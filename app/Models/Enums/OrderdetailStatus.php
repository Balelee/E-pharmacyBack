<?php

namespace App\Models\Enums;

use Illuminate\Support\Arr;
use App\Models\Enums\AdvancedEnum;
use App\Models\Enums\AdvancedEnumInterface;

enum OrderdetailStatus: string implements AdvancedEnumInterface
{
    use AdvancedEnum;

    case DISPONIBLE = 'disponible';
    case INDISPONIBLE = 'indisponible';

    public function label(): string
    {
        return __('orderdetail.status.'.$this->value);
    }

    public static function default(): string
    {
        return self::DISPONIBLE->value;
    }

    public function color(): string
    {
        return Arr::get($this->colors(), $this->value);
    }

    public function colors(): array
    {
        return [
            self::DISPONIBLE->value => '0xFF28A745',
            self::INDISPONIBLE->value => '0xFFDC3545',
        ];
    }
}
