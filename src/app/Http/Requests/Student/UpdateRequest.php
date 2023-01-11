<?php

declare(strict_types=1);

namespace App\Http\Requests\Student;

use App\Exceptions\BadRequestException;
use App\Models\Student;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

final class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'name'            => ['nullable', 'string'],
            'email'           => ['nullable', 'email'],
            'tel'             => ['nullable', 'string'],
            'address'         => ['nullable', 'string'],
            'payment_status'  => ['nullable', 'string'],
            'learning_status' => ['nullable', 'string'],
        ];
    }

    /**
     * @return Student
     */
    public function makeStudent(): Student
    {
        // バリデーションした値で Post を作成
        return new Student($this->validated());
    }

    /**
     * バリデーションエラー ハンドリング
     *
     * @param Validator $validator
     *
     * @return void
     *
     * @throws BadRequestException
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new BadRequestException('ご入力いただいた内容に誤りがございます。');
    }

    /**
     * Handle a failed authorization attempt.
     *
     * @return void
     *
     * @throws AuthorizationException
     */
    protected function failedAuthorization(): void
    {
        throw new AuthorizationException('書き込み権限がありません。');
    }
}
