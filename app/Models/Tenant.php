<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Amenity;

class Tenant extends Model
{
    use HasFactory;
    protected $fillable = ['first_name','last_name','email','phone'];

    public function leases(): HasMany
    {
        return $this->hasMany(Lease::class);
    }

    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class);
    }
}

