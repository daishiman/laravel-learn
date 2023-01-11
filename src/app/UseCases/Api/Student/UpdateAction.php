<?php

declare(strict_types=1);

namespace App\UseCases\Api\Student;

use App\Models\Student;
use App\Repositories\Api\Student\UpdateRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class UpdateAction
{
    /**
     * @var UpdateRepository
     */
    protected UpdateRepository $updateRepository;

    /**
     * @param UpdateRepository $updateRepository
     */
    public function __construct(UpdateRepository $updateRepository)
    {
        $this->updateRepository = $updateRepository;
    }

    /**
     * @param array<string> $newParams
     * @param int           $studentId
     *
     * @return Student|Model|Collection|array<int, string>
     */
    public function update(array $newParams, int $studentId): Student|Model|Collection|array
    {
        return $this->updateRepository->update($newParams, $studentId);
    }
}
