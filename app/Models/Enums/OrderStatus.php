<?php

namespace App\Models\Enums;

enum OrderStatus: string implements AdvancedEnumInterface
{
    use AdvancedEnum;

    case ENATTENTE = 'enattent';
    case VALIDE = 'valide';

    public function label(): string
    {
        return __('order.status.'.$this->value);
    }

    public static function default(): string
    {
        return self::ENATTENTE->value;
    }
}
