<?php

namespace Tests\Feature;

use App\Models\{User, Unit, Tenant, Lease};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_rejects_overlapping_lease(): void
    {
        $user   = User::factory()->create();
        $unit   = Unit::factory()->create();
        $tenant = Tenant::factory()->create();

        Lease::create([
            'unit_id'    => $unit->id,
            'tenant_id'  => $tenant->id,
            'start_date' => '2025-01-01',
            'end_date'   => '2025-12-31',
            'rent'       => 1000,
        ]);

        $response = $this->actingAs($user)->post('/leases', [
            'unit_id'    => $unit->id,
            'tenant_id'  => Tenant::factory()->create()->id,
            'start_date' => '2025-06-01',
            'end_date'   => '2025-06-30',
            'rent'       => 900,
        ]);

        $response->assertSessionHasErrors('unit_id');
    }

    public function test_update_rejects_overlapping_lease(): void
    {
        $user  = User::factory()->create();
        $unit  = Unit::factory()->create();
        $t1    = Tenant::factory()->create();
        $t2    = Tenant::factory()->create();

        Lease::create([
            'unit_id'    => $unit->id,
            'tenant_id'  => $t1->id,
            'start_date' => '2025-01-01',
            'end_date'   => '2025-12-31',
            'rent'       => 1000,
        ]);

        $lease = Lease::create([
            'unit_id'    => $unit->id,
            'tenant_id'  => $t2->id,
            'start_date' => '2026-01-01',
            'end_date'   => '2026-12-31',
            'rent'       => 800,
        ]);

        $response = $this->actingAs($user)->put("/leases/{$lease->id}", [
            'unit_id'    => $unit->id,
            'tenant_id'  => $t2->id,
            'start_date' => '2025-06-01',
            'end_date'   => '2025-06-30',
            'rent'       => 800,
        ]);

        $response->assertSessionHasErrors('unit_id');
    }
}
