<?php

namespace Tests\Feature;

use App\Models\Chirp;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChirpPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_update_own_chirp()
    {
        $user = User::factory()->create();
        $chirp = Chirp::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->patch("/chirps/{$chirp->id}", ['message' => 'Updated Chirp']);
        $response->assertRedirect();
        $this->assertDatabaseHas('chirps', ['id' => $chirp->id, 'message' => 'Updated Chirp']);
    }

    public function test_user_cannot_update_other_users_chirp()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $chirp = Chirp::factory()->for($otherUser)->create();
        $response = $this->actingAs($user)->patch("/chirps/{$chirp->id}", ['message' => 'ilegal Chirp update']);
        $response->assertForbidden();
        $this->assertDatabaseMissing('chirps', ['id' => $chirp->id, 'message' => 'ilegal Chirp update']);
    }

    public function test_user_can_delete_own_chirp()
    {
        $user = User::factory()->create();
        $chirp = Chirp::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->delete("/chirps/{$chirp->id}");
        $response->assertRedirect();
        $this->assertDatabaseMissing('chirps', ['id' => $chirp->id]);
    }

    public function test_user_cannot_delete_other_users_chirp()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $chirp = Chirp::factory()->for($otherUser)->create();
        $response = $this->actingAs($user)->delete("/chirps/{$chirp->id}");
        $response->assertForbidden();
        $this->assertDatabaseHas('chirps', ['id' => $chirp->id]);
    }
}
