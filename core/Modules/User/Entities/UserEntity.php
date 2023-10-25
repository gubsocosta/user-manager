<?php

namespace Core\Modules\User\Entities;

class UserEntity
{
    public function __construct(
        public readonly int $id,
        public readonly string $uid,
        public readonly string $password,
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly string $username,
        public readonly string $email,
        public readonly string $avatar,
        public readonly string $gender,
        public readonly string $phone_number,
        public readonly string $social_insurance_number,
        public readonly string $date_of_birth,
        public readonly EmploymentEntity $employment,
        public readonly AddressEntity $address,
        public readonly CreditCardEntity $credit_card,
        public readonly SubscriptionEntity $subscription,
    )
    {
    }
}
