<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;

class StartDateNotPast implements Rule
{
    public function passes($attribute, $value): bool
    {
        return Carbon::parse($value)->startOfDay()->gte(Carbon::today());
    }

    public function message(): string
    {
        return 'Data rozpoczęcia nie może być z przeszłości.';
    }
}
