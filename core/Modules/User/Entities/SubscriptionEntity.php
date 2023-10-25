<?php

namespace Core\Modules\User\Entities;

class SubscriptionEntity
{
    public function __construct(
        public readonly string $plan,
        public readonly string $status,
        public readonly string $payment_method,
        public readonly string $term
    )
    {
    }
}
