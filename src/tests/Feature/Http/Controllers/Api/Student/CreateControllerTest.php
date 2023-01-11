<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Api\Student;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class CreateControllerTest extends TestCase
{
    use DatabaseMigrations;

    private const TABLE_NAME = 'students';

    private static User $user;

    /**
     * @return void
     */
    public function test_生徒を作成できる_正常系()
    {
        $url = '/api/student';

        $login = $this->actingAs(self::$user)
                      ->getJson('/api/me');

        $params = [
            'name'            => 'まんじゅ',
            'email'           => 'manju@example.com',
            'tel'             => '09011111111',
            'address'         => '住所_1',
            'payment_status'  => '未払い',
            'learning_status' => '申請中',
        ];

        $response = $this->postJson($url, $params);

        $response->assertStatus(201);
        $this->assertDatabaseCount(self::TABLE_NAME, 1);
        $response->assertJsonFragment([
            'id'              => 1,
            'name'            => 'まんじゅ',
            'email'           => 'manju@example.com',
            'tel'             => '09011111111',
            'address'         => '住所_1',
            'payment_status'  => '未払い',
            'learning_status' => '申請中',
        ]);
    }

    /**
     * @return void
     */
    public function test_認可されていないユーザーで作成_異常系()
    {
        $url = '/api/student';

        $params = [
            'name'            => 'まんじゅ',
            'email'           => 'manju@example.com',
            'payment_status'  => '未払い',
            'learning_status' => '申請中',
        ];

        $response = $this->postJson($url, $params);

        $response->assertStatus(401);
        $this->assertDatabaseCount(self::TABLE_NAME, 0);
        $response->assertJsonFragment([
            'message' => 'Unauthenticated.'
        ]);
    }

    /**
     * @return void
     */
    public function test_バリデーションエラー_異常系()
    {
        $url = '/api/student';

        $login = $this->actingAs(self::$user)
                      ->getJson('/api/me');

        $params = [
            'name'            => '',
            'email'           => '',
            'payment_status'  => '',
            'learning_status' => '',
        ];

        $response = $this->postJson($url, $params);

        $response->assertStatus(400);
        $this->assertDatabaseCount(self::TABLE_NAME, 0);
        $response->assertJsonFragment([
            'message' => 'ご入力いただいた内容に誤りがございます。'
        ]);
    }

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:refresh');

        self::$user = User::factory()->create([
            'name'     => '先生',
            'email'    => 'teacher@example.com',
            'password' => 'password'
        ]);
    }
}
