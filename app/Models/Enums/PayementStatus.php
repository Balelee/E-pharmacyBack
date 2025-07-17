<?php

namespace App\Models\Enums;

use App\Models\Enums\AdvancedEnum;
use App\Models\Enums\AdvancedEnumInterface;

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
