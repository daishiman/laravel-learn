<?php

declare(strict_types=1);

namespace App\Enums;

enum LearningStatus: string
{
    case PENDING = 'pending';   // 申請中
    case STUDYING = 'studying'; // 学習中
    case LEAVE = 'leave';       // 退会済み

    /**
     * @return string
     */
    public function description(): string
    {
        return match ($this) {
            self::PENDING => '申請中',
            self::STUDYING => '学習中',
            self::LEAVE => '退会済み',
        };
    }
}
