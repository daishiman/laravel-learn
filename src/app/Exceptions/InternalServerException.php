<?php

declare(strict_types=1);

namespace App\Exceptions;

/**
 * リクエスト内容のエラー
 */
class InternalServerException extends MyHttpException
{
    // 取り扱うステータスコード
    public const STATUS_CODE = 500;

    /**
     * constructor.
     *
     * @param string $message 簡易エラーメッセージ
     */
    public function __construct(string $message = 'internal server error')
    {
        // super コンストラクタ
        parent::__construct($message, self::STATUS_CODE);
    }
}
