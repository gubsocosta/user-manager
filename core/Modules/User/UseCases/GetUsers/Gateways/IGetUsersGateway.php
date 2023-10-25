<?php

namespace Core\Modules\User\UseCases\GetUsers\Gateways;

use Core\Modules\User\Entities\UserEntity;
use Illuminate\Support\Collection;

interface IGetUsersGateway
{
    /**
     * @return Collection<UserEntity>
     */
    public function getUsers(): Collection;
}
