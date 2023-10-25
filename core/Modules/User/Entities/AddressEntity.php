<?php

namespace Core\Modules\User\Entities;

class AddressEntity
{
    public function __construct(
        public readonly string $city,
        public readonly string $street_name,
        public readonly string $street_address,
        public readonly string $zip_code,
        public readonly string $state,
        public readonly string $country,
        public readonly CoordinatesEntity $coordinates
    )
    {
    }
}
