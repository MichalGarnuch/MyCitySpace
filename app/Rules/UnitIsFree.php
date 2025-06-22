<?php

namespace App\Rules;

use App\Models\Unit;
use Illuminate\Contracts\Validation\Rule;

class UnitIsFree implements Rule
{
    public function passes($attribute, $value): bool
    {
        $unit = Unit::find($value);
        return $unit?->status === 'free';
    }

    public function message(): string
    {
        return 'Wybrany lokal jest już zajęty.';
    }
}
