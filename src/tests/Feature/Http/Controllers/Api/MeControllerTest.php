<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class MeControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_自身の認証に成功(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com'
        ]);

        $response = $this->actingAs($user)
                         ->getJson('/api/me');

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    /**
     * @return void
     */
    public function test_認証に失敗(): void
    {
        $response = $this->getJson('/api/me');

        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Unauthenticated.',
        ]);
    }
}
