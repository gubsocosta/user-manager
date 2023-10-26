<?php

namespace Core\Modules\User\UseCases\GetUsers;

use Core\Infra\Log\ILogHandler;
use Core\Modules\User\UseCases\GetUsers\Gateways\IGetUsersGateway;
use Exception;

final class GetUsersUseCase
{
    public function __construct(
        private readonly ILogHandler $logHandler,
        private readonly IGetUsersGateway $getUsersGateway
    )
    {
    }

    /**
     * @return GetUsersOutput
     * @throws Exception
     */
    public function execute(): GetUsersOutput
    {
        try {
            $users = $this->getUsersGateway->getUsers();
            $this->logHandler->info('Get users successfully');
            return new GetUsersOutput($users);
        } catch (Exception $exception) {
            $this->logHandler->error('Error when getting users: ' . $exception->getMessage());
            throw $exception;
        }
    }
}
