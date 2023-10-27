<?php

namespace App\Http\Controllers;

use Core\Modules\User\UseCases\GetUsers\GetUsersUseCase;
use Exception;
use Illuminate\Http\JsonResponse;

class GetUsersController extends Controller
{
    public function __construct(private readonly GetUsersUseCase $useCase)
    {
    }

    /**
     * Handle the incoming request.
     * @throws Exception
     */
    public function __invoke(): JsonResponse
    {
        $result = $this->useCase->execute();
        return response()->json($result->users);
    }
}
