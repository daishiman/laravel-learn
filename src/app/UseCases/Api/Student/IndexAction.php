<?php

declare(strict_types=1);

namespace App\UseCases\Api\Student;

use App\Repositories\Api\Student\IndexRepository;
use Illuminate\Support\Collection;

final class IndexAction
{
    /**
     * @var IndexRepository
     */
    protected IndexRepository $repository;

    /**
     * @param IndexRepository $repository
     */
    public function __construct(IndexRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->repository->index();
    }
}
