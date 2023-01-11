<?php

declare(strict_types=1);

namespace App\UseCases\Api\Student;

use App\Models\Student;
use App\Repositories\Api\Student\CreateRepository;

final class CreateAction
{
    /**
     * @var CreateRepository
     */
    protected CreateRepository $repository;

    /**
     * @param CreateRepository $repository
     */
    public function __construct(CreateRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Student $student
     *
     * @return Student
     */
    public function create(Student $student): Student
    {
        return $this->repository->create($student);
    }
}
