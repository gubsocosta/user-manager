<?php

namespace Tests\Unit\Core\Modules\User\UseCases;

use Core\Infra\Log\ILogger;
use Core\Modules\User\Entities\AddressEntity;
use Core\Modules\User\Entities\CoordinatesEntity;
use Core\Modules\User\Entities\CreditCardEntity;
use Core\Modules\User\Entities\EmploymentEntity;
use Core\Modules\User\Entities\SubscriptionEntity;
use Core\Modules\User\Entities\UserEntity;
use Core\Modules\User\UseCases\GetUsers\Gateways\IGetUsersGateway;
use Core\Modules\User\UseCases\GetUsers\GetUsersUseCase;
use Exception;
use PHPUnit\Framework\MockObject\Exception as PHPUnitException;
use PHPUnit\Framework\TestCase;

class GetUsersTest extends TestCase
{
    /**
     * @throws PHPUnitException
     */
    public function testShouldGetUsers(): void
    {
        $mockedRawJson = '{
            "id": 4980,
            "uid": "2b77882b-52a8-4e8f-a947-579d4894cdee",
            "password": "Kur96BOzZJ",
            "first_name": "Reginald",
            "last_name": "Padberg",
            "username": "reginald.padberg",
            "email": "reginald.padberg@email.com",
            "avatar": "https://robohash.org/veritatisidquia.png?size=300x300&set=set1",
            "gender": "Genderfluid",
            "phone_number": "+503 586-119-8544 x96788",
            "social_insurance_number": "717954218",
            "date_of_birth": "1982-06-24",
            "employment": {
                "title": "Direct Supervisor",
                "key_skill": "Fast learner"
            },
            "address": {
                "city": "Socorroberg",
                "street_name": "Josie Roads",
                "street_address": "8723 Gail Parks",
                "zip_code": "89649-2239",
                "state": "Minnesota",
                "country": "United States",
                "coordinates": {
                    "lat": 77.43475361621594,
                    "lng": 95.49931162961076
                }
            },
            "credit_card": {
                "cc_number": "4889-1797-6525-6334"
            },
            "subscription": {
                "plan": "Business",
                "status": "Idle",
                "payment_method": "Cash",
                "term": "Monthly"
            }
        }';

        $data = json_decode($mockedRawJson, true);
        $mockedUser = new UserEntity(
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
        $mockedLogger = $this->createMock(ILogger::class);
        $mockedLogger->expects($this->never())
            ->method('error');
        $mockedLogger->expects($this->once())
            ->method('info');
        $mockedGateway = $this->createMock(IGetUsersGateway::class);
        $mockedGateway->expects($this->once())
            ->method('getUsers')
            ->willReturn(collect([$mockedUser]));
        $useCase = new GetUsersUseCase($mockedLogger, $mockedGateway);
        $result = $useCase->execute();
        $users = $result->users;
        $this->assertCount(1, $users);
        $this->assertInstanceOf(UserEntity::class, $users->first());
    }

    /**
     * @throws PHPUnitException
     */
    public function testShouldThrowAnExceptionWhenGatewayFails(): void
    {
        $mockedLogger = $this->createMock(ILogger::class);
        $mockedLogger->expects($this->once())
            ->method('error');
        $mockedLogger->expects($this->never())
            ->method('info');
        $mockedGateway = $this->createMock(IGetUsersGateway::class);
        $mockedGateway->expects($this->once())
            ->method('getUsers')
            ->willThrowException(new Exception('any error'));
        $useCase = new GetUsersUseCase($mockedLogger, $mockedGateway);
        try {
            $useCase->execute();
        } catch (Exception $e) {
            $this->assertEquals('any error', $e->getMessage());
        }
    }
}
