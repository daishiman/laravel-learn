<?php

declare(strict_types=1);

namespace App\Exceptions;

/**
 * リクエスト 重複 エラー
 */
class ConflictException extends MyHttpException
{
    // 取り扱うステータスコード
    public const STATUS_CODE = 409;

    /**
     * constructor.
     *
     * @param string $message 簡易エラーメッセージ
     */
    public function __construct(string $message = 'conflict')
    {
        // super コンストラクタ
        parent::__construct($message, self::STATUS_CODE);
    }
}
