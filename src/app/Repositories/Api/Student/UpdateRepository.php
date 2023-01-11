<?php

declare(strict_types=1);

namespace App\Repositories\Api\Student;

use App\Exceptions\BadRequestException;
use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateRepository
{
    /**
     * @param array<string> $newParams
     * @param int           $studentId
     *
     * @return Collection|Model|Student|array<Student>|array<int, string>
     *
     * @throws ModelNotFoundException<Model>
     */
    public function update(array $newParams, int $studentId): Student|array|Collection|Model
    {
        $isNew = Student::find($studentId)
                        ->update($newParams);
        if ($isNew) {
            return Student::find($studentId);
        }

        return throw new BadRequestException('更新に失敗しました');
    }
}
