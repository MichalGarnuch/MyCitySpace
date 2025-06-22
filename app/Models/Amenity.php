<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\{Property, Tenant};

class Amenity extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function units(): BelongsToMany
    {
        return $this->belongsToMany(Unit::class);
    }

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class);
    }

    public function tenants(): BelongsToMany
    {
        return $this->belongsToMany(Tenant::class);
    }
}
