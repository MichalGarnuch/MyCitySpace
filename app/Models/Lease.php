<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Lease extends Model
{
    use HasFactory;
    protected $fillable = ['unit_id','tenant_id','start_date','end_date','rent'];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Sprawdza, czy istnieje kolidująca umowa dla wskazanego lokalu.
     */
    public static function conflictsWith(int $unitId, string $start, ?string $end, ?int $ignoreId = null): bool
    {
        $query = self::where('unit_id', $unitId);

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        $endDate = $end ?? '9999-12-31';

        return $query
            ->where('start_date', '<=', $endDate)
            ->where(function ($q) use ($start) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', $start);
            })
            ->exists();
    }
}

