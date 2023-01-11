<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\Student;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     *
     * @return array<string, array<string, mixed>|int>
     */
    public function toArray($request): array
    {
        return [
            'student' => [
                'id'              => $this->resource->id,
                'name'            => $this->resource->name,
                'email'           => $this->resource->email,
                'tel'             => $this->resource->tel,
                'address'         => $this->resource->address,
                'payment_status'  => $this->resource->payment_status,
                'learning_status' => $this->resource->learning_status,
                'updated_at'      => $this->resource->updated_at,
                'created_at'      => $this->resource->created_at,
            ],
            'status'  => 200,
        ];
    }
}
