<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Student;

use App\Exceptions\BadRequestException;
use App\Exceptions\InternalServerException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Student\UpdateRequest;
use App\Http\Resources\Api\Student\UpdateResource;
use App\Models\Student;
use App\UseCases\Api\Student\UpdateAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

final class UpdateController extends Controller
{
    protected UpdateAction $action;

    /**
     * @param UpdateAction $action
     */
    public function __construct(UpdateAction $action)
    {
        $this->action = $action;
    }

    /**
     * Handle the incoming request.
     *
     * @param UpdateRequest $request
     * @param Student       $student
     *
     * @return UpdateResource
     */
    public function __invoke(UpdateRequest $request, Student $student)
    {
        if (empty($request->all())) {
            return throw new BadRequestException('更新のための情報が足りません');
        }

        $user = Auth::user();

        $newParams = $request->makeStudent()->toArray();

        $studentId = $student['id'];

        try {
            DB::beginTransaction();
            $updateStudent = $this->action->update($newParams, $studentId);

            return new UpdateResource($updateStudent);
        } catch (Throwable $e) {
            return throw new InternalServerException('更新できませんでした。');
        }
    }
}
