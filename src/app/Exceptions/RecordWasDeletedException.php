<?php

declare(strict_types=1);

namespace App\Exceptions;

/**
 * その他 サーバー処理エラー
 */
class RecordWasDeletedException extends MyHttpException
{
    // 取り扱うステータスコード
    public const STATUS_CODE = 410;

    /**
     * constructor.
     *
     * @param string $message 簡易エラーメッセージ
     */
    public function __construct(string $message = 'gone')
    {
        // super コンストラクタ
        parent::__construct($message, self::STATUS_CODE);
    }
}
