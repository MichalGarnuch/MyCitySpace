<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidRent;
use App\Rules\ValidDateRange;
use App\Rules\StartDateNotPast;
use App\Rules\UnitIsFree;
use App\Rules\UnitAvailableForDates;

class LeaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $leaseId = $this->route('lease')?->id;

        $unitRules = [
            'required',
            'exists:units,id',
            new UnitAvailableForDates($this->input('start_date'), $this->input('end_date'), $leaseId),
        ];

        if ($this->isMethod('post')) {
            $unitRules[] = new UnitIsFree();
        }

        return [
            'tenant_id'  => ['required', 'exists:tenants,id'],
            'unit_id'    => $unitRules,
            'start_date' => ['required', 'date', new StartDateNotPast()],
            'end_date'   => ['nullable', 'date', new ValidDateRange($this->input('start_date'))],
            'rent'       => ['required', new ValidRent()],
        ];
    }
}
