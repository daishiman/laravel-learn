<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\StudentFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Student
 *
 * @property int    $id student_id
 * @property string $name 名前
 * @property string $email メールアドレス
 * @property string $payment_status 支払い状況
 * @property string $learning_status 学習状況
 * @property Carbon $created_at 登録日時
 * @property Carbon $updated_at 更新日時
 * @property string $tel 電話番号
 * @property string $address 住所
 *
 * @method static StudentFactory factory(...$parameters)
 * @method static Builder|Student newModelQuery()
 * @method static Builder|Student newQuery()
 * @method static Builder|Student query()
 * @method static Builder|Student whereAddress($value)
 * @method static Builder|Student whereCreatedAt($value)
 * @method static Builder|Student whereEmail($value)
 * @method static Builder|Student whereId($value)
 * @method static Builder|Student whereLearningStatus($value)
 * @method static Builder|Student whereName($value)
 * @method static Builder|Student wherePaymentStatus($value)
 * @method static Builder|Student whereTel($value)
 * @method static Builder|Student whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'tel',
        'address',
        'payment_status',
        'learning_status',
    ];
}
