<?php

namespace Core\Modules\User\Entities;

class CreditCardEntity
{
    public function __construct(public readonly string $cc_number)
    {
    }
}
