<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Student\ShowResource;
use App\Models\Student;
use App\UseCases\Api\Student\ShowAction;
use Illuminate\Support\Facades\Auth;

final class ShowController extends Controller
{
    protected ShowAction $action;

    /**
     * @param ShowAction $action
     */
    public function __construct(ShowAction $action)
    {
        $this->action = $action;
    }

    /**
     * Handle the incoming request.
     *
     * @param Student $student
     *
     * @return ShowResource
     */
    public function __invoke(Student $student): ShowResource
    {
        $user = Auth::id();

        $result = $this->action->show($student);

        return new ShowResource($result);
    }
}
