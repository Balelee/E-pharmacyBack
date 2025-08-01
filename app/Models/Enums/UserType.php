<?php

namespace App\Models\Enums;

use App\Models\Enums\AdvancedEnum;
use App\Models\Enums\AdvancedEnumInterface;

enum UserType: string implements AdvancedEnumInterface
{
    use AdvancedEnum;

    case CLIENT = 'client';
    case PHARMACIEN = 'pharmacien';

    public function label(): string
    {
        return __('user.type.'.$this->value);
    }

    public static function default(): string
    {
        return self::CLIENT->value;
    }
}
