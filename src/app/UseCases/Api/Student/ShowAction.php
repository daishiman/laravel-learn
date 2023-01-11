<?php

declare(strict_types=1);

namespace App\UseCases\Api\Student;

use App\Models\Student;
use App\Repositories\Api\Student\ShowRepository;

final class ShowAction
{
    /**
     * @var ShowRepository
     */
    protected ShowRepository $repository;

    /**
     * @param ShowRepository $repository
     */
    public function __construct(ShowRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Student $student *
     *
     * @return Student
     */
    public function show(Student $student): Student
    {
        return $this->repository->show($student);
    }
}
