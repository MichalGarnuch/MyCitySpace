<?php

namespace Tests\Feature;

use App\Models\{Property, User};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyTest extends TestCase
{
    use RefreshDatabase;

    public function test_property_is_created_with_valid_data(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/properties', [
            'name' => 'Nowa Nieruchomość',
            'address' => 'Testowa 1',
        ]);

        $response->assertRedirect(route('properties.index', absolute: false));
        $this->assertDatabaseHas('properties', [
            'name' => 'Nowa Nieruchomość',
            'address' => 'Testowa 1',
        ]);
    }

    public function test_property_name_is_required(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/properties', [
            // brak nazwy
            'address' => 'Testowa 1',
        ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_property_can_be_updated(): void
    {
        $user = User::factory()->create();
        $property = Property::factory()->create();

        $response = $this->actingAs($user)->put("/properties/{$property->id}", [
            'name' => 'Zmieniona',
            'address' => 'Zmienna 2',
        ]);

        $response->assertRedirect(route('properties.index', absolute: false));
        $property->refresh();
        $this->assertSame('Zmieniona', $property->name);
    }

    public function test_property_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $property = Property::factory()->create();

        $response = $this->actingAs($user)->delete("/properties/{$property->id}");

        $response->assertRedirect(route('properties.index', absolute: false));
        $this->assertDatabaseMissing('properties', [
            'id' => $property->id,
        ]);
    }
}
