<?php

namespace App\Models\Enums;

use Illuminate\Support\Arr;

enum OrderStatus: string implements AdvancedEnumInterface
{
    use AdvancedEnum;

    case ENATTENTE = 'enattent';
    case TRAITE = 'traite';
    case ANNULER = 'annule';
    case EXPIRE = 'expire';

    public function label(): string
    {
        return __('order.status.'.$this->value);
    }

    public static function default(): string
    {
        return self::ENATTENTE->value;
    }

    public function color(): string
    {
        return Arr::get($this->colors(), $this->value);
    }

    public function colors(): array
    {
        return [
            self::TRAITE->value => '0xFF28A745',
            self::ANNULER->value => '0xFFDC3545',
            self::ENATTENTE->value => '0xFFFFC107',
            self::EXPIRE->value => '0xFFDC3545',
        ];
    }
}
