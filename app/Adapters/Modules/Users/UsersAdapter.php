<?php

namespace App\Adapters\Modules\Users;

use Core\Infra\Http\IHttpClient;
use Core\Modules\User\Entities\AddressEntity;
use Core\Modules\User\Entities\CoordinatesEntity;
use Core\Modules\User\Entities\CreditCardEntity;
use Core\Modules\User\Entities\EmploymentEntity;
use Core\Modules\User\Entities\SubscriptionEntity;
use Core\Modules\User\Entities\UserEntity;
use Core\Modules\User\UseCases\GetUsers\Gateways\IGetUsersGateway;
use Illuminate\Support\Collection;
use UnexpectedValueException;

class UsersAdapter implements IGetUsersGateway
{
    public function __construct(
        private readonly IHttpClient $httpClient
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function getUsers(): Collection
    {
        $response = $this->httpClient->get('https://random-data-api.com/api/v2/users?size=100');
        if ($response->getStatusCode() !== 200) {
            throw new UnexpectedValueException('error to get users');
        }
        $decodedJson = json_decode($response->getBody(), true);
        return collect(array_map(fn($item) => $this->mapToUser($item), $decodedJson));
    }

    /**
     * @param array $data
     * @return UserEntity
     */
    private function mapToUser(array $data): UserEntity
    {
        return new UserEntity(
            $data['id'],
            $data['uid'],
            $data['password'],
            $data['first_name'],
            $data['last_name'],
            $data['username'],
            $data['email'],
            $data['avatar'],
            $data['gender'],
            $data['phone_number'],
            $data['social_insurance_number'],
            $data['date_of_birth'],
            new EmploymentEntity(
                $data['employment']['title'],
                $data['employment']['key_skill']
            ),
            new AddressEntity(
                $data['address']['city'],
                $data['address']['street_name'],
                $data['address']['street_address'],
                $data['address']['zip_code'],
                $data['address']['state'],
                $data['address']['country'],
                new CoordinatesEntity(
                    $data['address']['coordinates']['lat'],
                    $data['address']['coordinates']['lng']
                )
            ),
            new CreditCardEntity($data['credit_card']['cc_number']),
            new SubscriptionEntity(
                $data['subscription']['plan'],
                $data['subscription']['status'],
                $data['subscription']['payment_method'],
                $data['subscription']['term']
            )
        );
    }
}
