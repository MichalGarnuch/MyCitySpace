<?php

namespace Tests\Feature;

use App\Models\{User, Unit, Tenant, Lease, Property};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeaseTest extends TestCase
{
    use RefreshDatabase;
    public function test_lease_is_created_with_valid_data(): void
    {
        $user = User::factory()->create();
        $property = Property::factory()->create();
        $unit = Unit::factory()->for($property)->create();
        $tenant = Tenant::factory()->create();

        $response = $this->actingAs($user)->post('/leases', [
            'tenant_id' => $tenant->id,
            'unit_id' => $unit->id,
            'start_date' => '2024-01-01',
            'end_date' => '2024-12-31',
            'rent' => 1234.56,
        ]);

        $response->assertRedirect(route('leases.index', absolute: false));
        $this->assertDatabaseHas('leases', [
            'tenant_id' => $tenant->id,
            'unit_id' => $unit->id,
            'rent' => 1234.56,
        ]);
    }

    public function test_end_date_must_be_after_start_date(): void
    {
        $user = User::factory()->create();
        $property = Property::factory()->create();
        $unit = Unit::factory()->for($property)->create();
        $tenant = Tenant::factory()->create();

        $response = $this->actingAs($user)->post('/leases', [
            'tenant_id' => $tenant->id,
            'unit_id' => $unit->id,
            'start_date' => '2024-12-31',
            'end_date' => '2024-01-01',
            'rent' => 1000,
        ]);

        $response->assertSessionHasErrors('end_date');
    }

    public function test_lease_can_be_updated(): void
    {
        $user = User::factory()->create();
        $lease = Lease::factory()->create();
        $property = $lease->unit->property;
        $unit = $lease->unit;
        $tenant = $lease->tenant;

        $response = $this->actingAs($user)->put("/leases/{$lease->id}", [
            'tenant_id' => $tenant->id,
            'unit_id' => $unit->id,
            'start_date' => '2024-02-01',
            'end_date' => '2024-12-31',
            'rent' => 1500,
        ]);

        $response->assertRedirect(route('leases.index', absolute: false));
        $lease->refresh();
        $this->assertSame('2024-02-01', $lease->start_date);
        $this->assertSame(1500.0, (float) $lease->rent);
    }

    public function test_lease_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $lease = Lease::factory()->create();

        $response = $this->actingAs($user)->delete("/leases/{$lease->id}");

        $response->assertRedirect(route('leases.index', absolute: false));
        $this->assertDatabaseMissing('leases', [
            'id' => $lease->id,
        ]);
    }
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
