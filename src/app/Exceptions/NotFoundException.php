<?php

declare(strict_types=1);

namespace App\Exceptions;

/**
 * リクエスト 存在チェック エラー
 */
class NotFoundException extends MyHttpException
{
    // 取り扱うステータスコード
    public const STATUS_CODE = 404;

    /**
     * constructor.
     *
     * @param string $message 簡易エラーメッセージ
     */
    public function __construct(string $message = 'Not Found')
    {
        // super コンストラクタ
        parent::__construct($message, self::STATUS_CODE);
    }
}
