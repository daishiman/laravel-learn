<?php

declare(strict_types=1);

namespace App\Exceptions;

/**
 * リクエスト 予約残数 存在チェック エラー
 */
class NotExistReserveStockException extends MyHttpException
{
    // 取り扱うステータスコード
    public const STATUS_CODE = 409;

    /**
     * constructor.
     *
     * @param string $message 簡易エラーメッセージ
     */
    public function __construct(string $message = 'Not Exist stock')
    {
        // super コンストラクタ
        parent::__construct($message, self::STATUS_CODE);
    }
}
