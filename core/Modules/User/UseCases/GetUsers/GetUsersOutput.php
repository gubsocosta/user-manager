<?php

namespace Core\Modules\User\UseCases\GetUsers;

use Core\Modules\User\Entities\UserEntity;
use Illuminate\Support\Collection;

class GetUsersOutput
{
    /**
     * @param Collection<UserEntity> $users
     */
    public function __construct(
        public readonly Collection $users
    )
    {
    }
}
