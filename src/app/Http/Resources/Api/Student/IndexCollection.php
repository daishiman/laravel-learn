<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\Student;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class IndexCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     *
     * @return array<string, Collection|int>
     */
    public function toArray($request): array
    {
        return [
            'student' => $this->collection,
            'status'  => 200,
        ];
    }
}
