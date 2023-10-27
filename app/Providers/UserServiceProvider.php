<?php

namespace App\Providers;

use App\Adapters\Infra\Http\LaravelHttpClient;
use App\Adapters\Infra\Http\LaravelHttpResponse;
use App\Adapters\Infra\Log\LaravelLogHandler;
use App\Adapters\Modules\Users\UserAdapter;
use App\Http\Controllers\GetUsersController;
use Core\Infra\Http\IHttpClient;
use Core\Infra\Http\IHttpResponse;
use Core\Infra\Log\ILogHandler;
use Core\Modules\User\UseCases\GetUsers\Gateways\IGetUsersGateway;
use Core\Modules\User\UseCases\GetUsers\GetUsersUseCase;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ILogHandler::class, LaravelLogHandler::class);
        $this->app->bind(IHttpResponse::class, LaravelHttpResponse::class);
        $this->app->bind(IHttpClient::class, LaravelHttpClient::class);
        $this->app->bind(IGetUsersGateway::class, UserAdapter::class);
        $this->app->bind(UserAdapter::class, function (Application $app) {
            return new UserAdapter($app->make(LaravelHttpClient::class));
        });
        $this->app->bind(GetUsersUseCase::class, function (Application $app) {
            return new GetUsersUseCase(
                $app->make(ILogHandler::class),
                $app->make(IGetUsersGateway::class)
            );
        });
        $this->app->bind(GetUsersController::class, function (Application $app) {
            return new GetUsersController($app->make(GetUsersUseCase::class));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
