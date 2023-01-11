<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Api\Student;

use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class UpdateControllerTest extends TestCase
{
    use DatabaseMigrations;

    private const TABLE_NAME = 'students';

    private static User    $user;
    private static Student $student_1;
    private static Student $student_2;
    private static Student $student_3;

    /**
     * @return void
     */
    public function test_生徒を更新_正常系()
    {
        $url = '/api/student/1';

        $login = $this->actingAs(self::$user)
                      ->getJson('/api/me');

        $params = [
            'name'            => 'まんじゅ',
            'email'           => 'manju@example.com',
            'tel'             => '09011111112',
            'address'         => '住所11',
            'payment_status'  => '支払い済み',
            'learning_status' => '学習中',
        ];

        $response = $this->json('PUT', $url, $params);

        $response->assertStatus(200);
        $this->assertDatabaseCount(self::TABLE_NAME, 3);
        $response->assertJsonFragment([
            'id'              => 1,
            'name'            => 'まんじゅ',
            'email'           => 'manju@example.com',
            'tel'             => '09011111112',
            'address'         => '住所11',
            'payment_status'  => '支払い済み',
            'learning_status' => '学習中',
        ]);
    }

    /**
     * @return void
     */
    public function test_支払いステータスのみ更新_正常系()
    {
        $url = '/api/student/1';

        $login = $this->actingAs(self::$user)
                      ->getJson('/api/me');

        $params = [
            'payment_status' => 'キャンセル',
        ];

        $response = $this->json('PUT', $url, $params);

        $response->assertStatus(200);
        $this->assertDatabaseCount(self::TABLE_NAME, 3);
        $response->assertJsonFragment([
            'id'              => 1,
            'name'            => '生徒_1',
            'email'           => 'student_1@example.com',
            'payment_status'  => 'キャンセル',
            'learning_status' => '申請中',
        ]);
    }

    /**
     * @return void
     */
    public function test_認可されていないユーザーで作成_異常系()
    {
        $url = '/api/student/1';

        $params = [
            'name'            => 'まんじゅ',
            'email'           => 'manju@example.com',
            'payment_status'  => '支払い済み',
            'learning_status' => '学習中',
        ];

        $response = $this->json('PUT', $url, $params);

        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Unauthenticated.'
        ]);
    }

    /**
     * @return void
     */
    public function test_更新情報なし_異常系()
    {
        $url = '/api/student/1';

        $login = $this->actingAs(self::$user)
                      ->getJson('/api/me');

        $params = [];

        $response = $this->json('PUT', $url, $params);

        $response->assertStatus(400);
        $this->assertDatabaseCount(self::TABLE_NAME, 3);
        $response->assertJson([
            'message' => '更新のための情報が足りません',
            'code'    => 'bad_request',
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

        self::$student_1 = Student::factory()
                                  ->state([
                                      'name'            => '生徒_1',
                                      'email'           => 'student_1@example.com',
                                      'tel'             => '09011111111',
                                      'address'         => '住所1',
                                      'payment_status'  => '支払い済み',
                                      'learning_status' => '申請中',
                                      'created_at'      => '2022-12-27 00:00:00',
                                      'updated_at'      => '2022-12-27 00:00:00',
                                  ])
                                  ->create();

        self::$student_2 = Student::factory()
                                  ->state([
                                      'name'            => '生徒_2',
                                      'email'           => 'student_2@example.com',
                                      'tel'             => '09022222222',
                                      'address'         => '住所2',
                                      'payment_status'  => '未払い',
                                      'learning_status' => '申請中',
                                      'created_at'      => '2028-12-27 00:00:00',
                                      'updated_at'      => '2028-12-27 00:00:00',
                                  ])
                                  ->create();

        self::$student_3 = Student::factory()
                                  ->state([
                                      'name'            => '生徒_4',
                                      'email'           => 'student_4@example.com',
                                      'tel'             => '09044444444',
                                      'address'         => '住所4',
                                      'payment_status'  => 'キャンセル',
                                      'learning_status' => '退会済み',
                                      'created_at'      => '2012-12-27 00:00:00',
                                      'updated_at'      => '2012-12-27 00:00:00',
                                  ])
                                  ->create();
    }
}
