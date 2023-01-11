<?php

declare(strict_types=1);

namespace App\Exceptions;

/**
 * メール送信エラー
 */
class SendEmailException extends InternalServerException
{
    /**
     * constructor.
     *
     * @param string $message 簡易エラーメッセージ
     */
    public function __construct(string $message = 'internal server error')
    {
        // super コンストラクタ
        parent::__construct($message);
    }
}
