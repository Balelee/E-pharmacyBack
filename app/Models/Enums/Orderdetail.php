<?php

namespace App\Models\Enums;

enum Orderdetail: string implements AdvancedEnumInterface
{
    use AdvancedEnum;

    case DISPONIBLE = 'disponible';
    case INDISPONIBLE = 'indisponible';

    public function label(): string
    {
        return __('order.status.'.$this->value);
    }

    public static function default(): string
    {
        return self::DISPONIBLE->value;
    }
}
