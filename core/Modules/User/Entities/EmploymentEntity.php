<?php

namespace Core\Modules\User\Entities;

class EmploymentEntity
{
    public function __construct(
        public readonly string $title,
        public readonly string $key_skill
    )
    {
    }
}
