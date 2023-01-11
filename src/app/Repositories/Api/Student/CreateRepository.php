<?php

declare(strict_types=1);

namespace App\Repositories\Api\Student;

use App\Models\Student;

class CreateRepository
{
    /**
     * @param Student $student
     *
     * @return Student
     */
    public function create(Student $student): Student
    {
        $student->save();

        return $student;
    }
}
