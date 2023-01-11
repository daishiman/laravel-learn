<?php

declare(strict_types=1);

namespace App\Enums;

enum PaymentStatus: string
{
    case PAID = 'paid';      // 支払い済み
    case UNPAID = 'unpaid';  // 未払い
    case CANCEL = 'cancel';  // キャンセル

    /**
     * @return string
     */
    public function description(): string
    {
        return match ($this) {
            self::PAID => '支払い済み',
            self::UNPAID => '未払い',
            self::CANCEL => 'キャンセル',
        };
    }
}
