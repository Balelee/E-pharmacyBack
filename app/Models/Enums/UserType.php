<?php

namespace App\Models\Enums;

enum UserType: string implements AdvancedEnumInterface
{
    use AdvancedEnum;
    case ADMIN = 'admin';
    case CLIENT = 'client';
    case PHARMACIEN = 'pharmacien';

    public function label(): string
    {
        return __('user.type.' . $this->value);
    }

    public static function default(): string
    {
        return self::CLIENT->value;
    }
}
