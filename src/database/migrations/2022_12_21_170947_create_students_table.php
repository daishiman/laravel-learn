<?php

use App\Enums\LearningStatus;
use App\Enums\PaymentStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->comment('生徒');
            $table->id()->comment('student_id');
            $table->string('name')->comment('名前');
            $table->string('email')->unique()->comment('メールアドレス');
            $table->string('payment_status')
                  ->default(PaymentStatus::PAID->description())
                  ->comment('支払い状況'); // デフォルト：未払い
            $table->string('learning_status')
                  ->default(LearningStatus::PENDING->description())
                  ->comment('学習状況');  // デフォルト：申請中
            $table->timestamp('created_at')->comment('登録日時');
            $table->timestamp('updated_at')->comment('更新日時');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
