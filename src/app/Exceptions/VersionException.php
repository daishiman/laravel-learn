<?php

declare(strict_types=1);

namespace App\Exceptions;

/**
 * リクエスト バージョン エラー
 */
class VersionException extends MyHttpException
{
    // 取り扱うステータスコード
    public const STATUS_CODE = 409;

    /**
     * constructor.
     *
     * @param string $message 簡易エラーメッセージ
     */
    public function __construct(string $message = 'version')
    {
        // super コンストラクタ
        parent::__construct($message, self::STATUS_CODE);
    }
}
