<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;

class ValidDateRange implements Rule
{
    private string $startDate;

    public function __construct(string $startDate)
    {
        $this->startDate = $startDate;
    }

    public function passes($attribute, $value): bool
    {
        if (empty($value)) {
            return true;
        }

        return Carbon::parse($this->startDate)->lte(Carbon::parse($value));
    }

    public function message(): string
    {
        return 'Data zakończenia musi być późniejsza niż data rozpoczęcia.';
    }
}
