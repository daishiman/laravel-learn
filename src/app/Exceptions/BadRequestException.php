<?php

declare(strict_types=1);

namespace App\Exceptions;

/**
 * その他 サーバー処理エラー
 */
class BadRequestException extends MyHttpException
{
    // 取り扱うステータスコード
    public const STATUS_CODE = 400;

    /**
     * constructor.
     *
     * @param string $message 簡易エラーメッセージ
     */
    public function __construct(string $message = 'invalid request')
    {
        // super コンストラクタ
        parent::__construct($message, self::STATUS_CODE);
    }
}
