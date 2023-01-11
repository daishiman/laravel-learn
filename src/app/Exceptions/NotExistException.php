<?php

declare(strict_types=1);

namespace App\Exceptions;

/**
 * リクエスト 存在チェック エラー
 */
class NotExistException extends MyHttpException
{
    // 取り扱うステータスコード
    public const STATUS_CODE = 410;

    /**
     * constructor.
     *
     * @param string $message 簡易エラーメッセージ
     */
    public function __construct(string $message = 'Not Exist')
    {
        // super コンストラクタ
        parent::__construct($message, self::STATUS_CODE);
    }
}
