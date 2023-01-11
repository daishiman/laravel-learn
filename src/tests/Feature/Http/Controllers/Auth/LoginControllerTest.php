<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_認証成功(): void
    {
        User::factory()->create([
            'email' => 'test@example.com'
        ]);

        $params = [
            'email'    => 'test@example.com',
            'password' => 'password',
        ];

        $response = $this->postJson('/login', $params);
        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Authenticated.',
        ]);
    }

    /**
     * @return void
     */
    public function test_認証失敗(): void
    {
        $params = [
            'email'    => 'test@example.com',
            'password' => 'password',
        ];

        $response = $this->postJson('/login', $params);

        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Unauthenticated.',
        ]);
    }

    /**
     * @return void
     */
    public function test_処理不能エンティティ(): void
    {
        $response = $this->postJson('/login', []);

        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'emailは、必ず指定してください。 (and 1 more error)',
            'errors'  => [
                'email'    => ['emailは、必ず指定してください。'],
                'password' => ['passwordは、必ず指定してください。'],
            ],
        ]);
    }
}
