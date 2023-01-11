<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Student;

use App\Exceptions\InternalServerException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Student\CreateRequest;
use App\Http\Resources\Api\Student\CreateResource;
use App\UseCases\Api\Student\CreateAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

final class CreateController extends Controller
{
    protected CreateAction $action;

    /**
     * @param CreateAction $action
     */
    public function __construct(CreateAction $action)
    {
        $this->action = $action;
    }

    /**
     * Handle the incoming request.
     *
     * @param CreateRequest $request
     *
     * @return CreateResource
     */
    public function __invoke(CreateRequest $request)
    {
        $user = Auth::user();

        $student = $request->makeStudent();

        try {
            DB::beginTransaction();
            $createStudent = $this->action->create($student);

            return new CreateResource($createStudent);
        } catch (Throwable $e) {
            return throw new InternalServerException('作成できませんでした。');
        }
    }
}
