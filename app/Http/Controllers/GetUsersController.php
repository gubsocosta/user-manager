<?php

namespace App\Http\Controllers;

use Core\Modules\User\UseCases\GetUsers\GetUsersUseCase;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GetUsersController extends Controller
{
    public function __construct(private readonly GetUsersUseCase $useCase)
    {
    }

    /**
     * Handle the incoming request.
     * @throws Exception
     */
    public function __invoke(Request $request): Response
    {
        $result = $this->useCase->execute();
        return response()->view('components.users.index', ['users' => $result->users]);
    }
}
