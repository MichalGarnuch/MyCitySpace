<?php
namespace App\Services;

use App\Models\Lease;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

final class LeaseWriter
{
    public function save(array $data, ?Lease $lease = null): Lease
    {
        return DB::transaction(function () use ($data, $lease) {
            // Lock the stable parent row: a query for absent overlapping leases
            // alone cannot serialize two first reservations of the same unit.
            Unit::query()->whereKey($data['unit_id'])->lockForUpdate()->firstOrFail();
            if (Lease::conflictsWith((int)$data['unit_id'], $data['start_date'], $data['end_date'] ?? null, $lease?->id)) {
                throw ValidationException::withMessages(['unit_id' => 'Lokal jest już wynajęty w tym okresie.']);
            }
            $target = $lease ?? new Lease();
            $target->fill($data)->save();
            return $target;
        }, 3);
    }
}
