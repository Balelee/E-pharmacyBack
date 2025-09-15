<?php

namespace App\Models\Enums;

enum OrderPharmacyStatus: string implements AdvancedEnumInterface
{
    use AdvancedEnum;

    case ACCEPTED = 'accepted';
    case REFUSED = 'refused';

    public function label(): string
    {
        return __('orderPharmacy.status.'.$this->value);
    }

    public static function default(): string
    {
        return self::ACCEPTED->value;
    }
}
