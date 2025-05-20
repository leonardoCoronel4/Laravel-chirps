<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChirpValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_chirp_message_is_required()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/chirps', [
            'message' => '',
        ])->assertSessionHasErrors('message');
    }

    public function test_chirp_message_is_at_most_255_characters()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/chirps', [
            'message' => 'a'.str_repeat('b', 255),
        ])->assertSessionHasErrors('message');
    }

    public function test_chirp_message_is_at_least_3_characters()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/chirps', [
            'message' => 'ab',
        ])->assertSessionHasErrors('message');
    }
}
