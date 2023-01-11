<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Api\Student;

use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ShowControllerTest extends TestCase
{
    use DatabaseMigrations;

    private const TABLE_NAME = 'students';

    private static User    $user;
    private static Student $student_1;
    private static Student $student_2;
    private static Student $student_3;
    private static Student $student_4;
    private static Student $student_5;

    /**
     * @return void
     */
    public function test_生徒詳細を作成できる_正常系()
    {
        $url = '/api/student/1';

        $login = $this->actingAs(self::$user)
                      ->getJson('/api/me');

        $response = $this->getJson($url);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'data' => [
                'status'  => 200,
                'student' => [
                    "id"              => 1,
                    "name"            => "生徒_1",
                    'email'           => 'student_1@example.com',
                    'tel'             => '09011111111',
                    'address'         => '住所1',
                    "payment_status"  => "支払い済み",
                    "learning_status" => "申請中",
                    "created_at"      => "2022-12-26T15:00:00.000000Z",
                    "updated_at"      => "2022-12-26T15:00:00.000000Z",
                ],
            ]
        ]);
    }

    /**
     * @return void
     */
    public function test_認可されていないユーザーで一覧取得_異常系()
    {
        $url = '/api/student/1';

        $response = $this->getJson($url);

        $response->assertStatus(401);
        $response->assertJsonFragment([
            'message' => 'Unauthenticated.'
        ]);
    }

    /**
     * @return void
     */
    public function test_生徒の登録がない_異常系()
    {
        // DB を初期化
        $url = '/api/student/99';

        $login = $this->actingAs(self::$user)
                      ->getJson('/api/me');

        $response = $this->getJson($url);

        $response->assertStatus(404);
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
                                      'payment_status'  => '支払い済み',
                                      'learning_status' => '学習中',
                                      'created_at'      => '2002-12-27 00:00:00',
                                      'updated_at'      => '2002-12-27 00:00:00',
                                  ])
                                  ->create();

        self::$student_3 = Student::factory()
                                  ->state([
                                      'name'            => '生徒_3',
                                      'email'           => 'student_3@example.com',
                                      'tel'             => '09033333333',
                                      'address'         => '住所3',
                                      'payment_status'  => '支払い済み',
                                      'learning_status' => '退会済み',
                                      'created_at'      => '2032-12-27 00:00:00',
                                      'updated_at'      => '2032-12-27 00:00:00',
                                  ])
                                  ->create();

        self::$student_4 = Student::factory()
                                  ->state([
                                      'name'            => '生徒_4',
                                      'email'           => 'student_4@example.com',
                                      'tel'             => '09044444444',
                                      'address'         => '住所4',
                                      'payment_status'  => '未払い',
                                      'learning_status' => '申請中',
                                      'created_at'      => '2028-12-27 00:00:00',
                                      'updated_at'      => '2028-12-27 00:00:00',
                                  ])
                                  ->create();

        self::$student_5 = Student::factory()
                                  ->state([
                                      'name'            => '生徒_5',
                                      'email'           => 'student_5@example.com',
                                      'tel'             => '09055555555',
                                      'address'         => '住所5',
                                      'payment_status'  => 'キャンセル',
                                      'learning_status' => '退会済み',
                                      'created_at'      => '2012-12-27 00:00:00',
                                      'updated_at'      => '2012-12-27 00:00:00',
                                  ])
                                  ->create();
    }
}
