<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\IndexRequest;
use App\Http\Resources\Api\Student\IndexCollection;
use App\UseCases\Api\Student\IndexAction;
use Illuminate\Support\Facades\Auth;

final class IndexController extends Controller
{
    protected IndexAction $action;

    /**
     * @param IndexAction $action
     */
    public function __construct(IndexAction $action)
    {
        $this->action = $action;
    }

    /**
     * Handle the incoming request.
     *
     * @param IndexRequest $request
     *
     * @return IndexCollection
     */
    public function __invoke(IndexRequest $request): IndexCollection
    {
        $user = Auth::user();

        $studentList = $this->action->index();

        return new IndexCollection($studentList);
    }
}
