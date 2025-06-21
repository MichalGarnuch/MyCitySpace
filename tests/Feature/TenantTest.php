<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TenantTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_is_required_when_creating_tenant(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/tenants', [
            'first_name' => 'Jan',
            'last_name'  => 'Kowalski',
            // e-mail celowo pominięty
            'phone'      => '123456789',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_tenant_is_created_with_valid_email(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/tenants', [
            'first_name' => 'Jan',
            'last_name'  => 'Kowalski',
            'email'      => 'jan@example.com',
            'phone'      => '123456789',
        ]);

        $response->assertRedirect(route('tenants.index', absolute: false));
        $this->assertDatabaseHas('tenants', [
            'email' => 'jan@example.com',
        ]);
    }
}
