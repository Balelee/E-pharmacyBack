<?php

namespace App\Models\Enums;

use App\Models\Enums\AdvancedEnum;
use App\Models\Enums\AdvancedEnumInterface;
enum PayementType: string implements AdvancedEnumInterface
{
    use AdvancedEnum;

    case ORANGE = 'orange';
    case MTN = 'mtn';
    case MOOV = 'moov';

    public function label(): string
    {
        return __('payement.type.'.$this->value);
    }

    public static function default(): string
    {
        return self::ORANGE->value;
    }
}
