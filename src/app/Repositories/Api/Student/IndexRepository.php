<?php

declare(strict_types=1);

namespace App\Repositories\Api\Student;

use App\Models\Student;
use Illuminate\Support\Collection;

class IndexRepository
{
    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return Student::orderByDesc('updated_at')
                      ->orderByDesc('id')
                      ->get();
    }
}
