<?php

declare(strict_types=1);

namespace App\Exceptions;

/**
 * 未認証のエラー
 */
class UnauthorizedException extends MyHttpException
{
    // 取り扱うステータスコード
    public const STATUS_CODE = 401;

    /**
     * constructor.
     *
     * @param string $message 簡易エラーメッセージ
     */
    public function __construct(string $message = 'un auth request')
    {
        // super コンストラクタ
        parent::__construct($message, self::STATUS_CODE);
    }
}
