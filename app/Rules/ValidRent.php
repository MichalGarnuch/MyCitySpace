<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidRent implements Rule
{
    public function passes($attribute, $value): bool
    {
        return is_numeric($value) && $value >= 100 && $value <= 100000;
    }

    public function message(): string
    {
        return 'Czynsz musi mieścić się w rozsądnym przedziale.';
    }
}
