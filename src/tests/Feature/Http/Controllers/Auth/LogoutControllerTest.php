<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class LogoutControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_ログアウト成功(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com'
        ]);

        $response = $this->actingAs($user)
                         ->postJson('/logout');

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Unauthenticated.',
        ]);

        $this->assertGuest();
    }

    /**
     * @return void
     */
    public function test_ログインしていない(): void
    {
        $response = $this->postJson('/logout');

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Already Unauthenticated.',
        ]);

        $this->assertGuest();
    }
}
