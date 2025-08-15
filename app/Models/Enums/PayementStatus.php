<?php

namespace App\Models\Enums;

enum PayementStatus: string implements AdvancedEnumInterface
{
    use AdvancedEnum;

    case ENATTENTE = 'enattent';
    case PAYE = 'paye';
    case ECHOUE = 'echoue';

    public function label(): string
    {
        return __('payementstatus.status.'.$this->value);
    }

    public static function default(): string
    {
        return self::ENATTENTE->value;
    }
}
