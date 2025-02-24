<?php

namespace App\Models\Enums;
enum ProductType: string implements AdvancedEnumInterface
{
    use AdvancedEnum;

    case SIROP ='sirop';
    case COMPRIME ='comprime';
    case SACHET ='sachet';
    case POUDRE ='poudre';
    case  FLACON='flacon';

    public function label(): string
    {
        return __('product.type.'.$this->value);
    }

    public static function default(): string
    {
        return self::COMPRIME->value;
    }
}
