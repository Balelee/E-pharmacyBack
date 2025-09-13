<?php

namespace App\Models\Enums;

use Illuminate\Support\Arr;

enum ModelStatus: string implements AdvancedEnumInterface
{
    use AdvancedEnum;

    case ACTIF = 'actif';
    case INACTIF = 'inactif';

    public function label(): string
    {
        return __('enums.model-status.'.$this->value);
    }

    public function color(): string
    {
        return Arr::get($this->colors(), $this->value);
    }

    public function colors(): array
    {
        return [
            self::ACTIF->value => 'success',
            self::INACTIF->value => 'danger',
        ];
    }
}
