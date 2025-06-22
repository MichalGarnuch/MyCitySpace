<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AmenityTest extends TestCase
{
    use RefreshDatabase;

    public function test_name_is_required_when_creating_amenity(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/amenities', []);

        $response->assertSessionHasErrors('name');
    }

    public function test_amenity_is_created_with_valid_name(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/amenities', [
            'name' => 'Parking',
        ]);

        $response->assertRedirect(route('amenities.index', absolute: false));
        $this->assertDatabaseHas('amenities', ['name' => 'Parking']);
    }
}
