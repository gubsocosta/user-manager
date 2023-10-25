<?php

namespace Core\Modules\User\UseCases\GetUsers;

use Core\Infra\Log\ILogger;
use Core\Modules\User\UseCases\GetUsers\Gateways\IGetUsersGateway;
use Exception;

final class GetUsersUseCase
{
    public function __construct(
        private readonly ILogger $logger,
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
            $this->logger->info('Get users successfully');
            return new GetUsersOutput($users);
        } catch (Exception $exception) {
            $this->logger->error('Error when getting users: ' . $exception->getMessage());
            throw $exception;
        }
    }
}
