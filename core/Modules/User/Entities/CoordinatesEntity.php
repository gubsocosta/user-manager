<?php

namespace Core\Modules\User\Entities;

class CoordinatesEntity
{
    public function __construct(
        public readonly float $lat,
        public readonly float $lng
    ) {}
}
