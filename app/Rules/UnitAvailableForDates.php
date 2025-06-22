<?php

namespace App\Rules;

use App\Models\Lease;
use Illuminate\Contracts\Validation\Rule;

class UnitAvailableForDates implements Rule
{
    private string $startDate;
    private ?string $endDate;
    private ?int $ignoreId;

    public function __construct(string $startDate, ?string $endDate, ?int $ignoreId = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->ignoreId = $ignoreId;
    }

    public function passes($attribute, $value): bool
    {
        if (! $value) {
            return true;
        }

        return ! Lease::conflictsWith($value, $this->startDate, $this->endDate, $this->ignoreId);
    }

    public function message(): string
    {
        return 'Wybrany lokal posiada już umowę w tym okresie.';
    }
}
