<?php

declare(strict_types=1);

namespace App\Repositories\Api\Student;

use App\Exceptions\NotFoundException;
use App\Models\Student;

class ShowRepository
{
    /**
     * @param Student $student *
     *
     * @return Student
     */
    public function show(Student $student): Student
    {
        $studentID = $student->id;

        $student = Student::find($studentID)->first();

        if ($student) {
            return $student;
        }

        return throw new NotFoundException('表示できるデータがありません');
    }
}
