<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateChirpTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_users_can_create_chirp()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/chirps', [
            'message' => 'Test Chirp',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('chirps', ['message' => 'Test Chirp', 'user_id' => $user->id]);
    }

    public function test_guest_users_cannot_create_chirp()
    {
        $this->post('/chirps', [
            'message' => 'Test Chirp',
        ])->assertRedirect('/login');
    }
}
