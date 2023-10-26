<?php

namespace Tests\Unit\App\Adapters\Modules\Users;

use App\Adapters\Modules\Users\UserAdapter;
use Core\Infra\Http\IHttpClient;
use Core\Infra\Http\IHttpResponse;
use Core\Modules\User\Entities\UserEntity;
use PHPUnit\Framework\MockObject\Exception as PHPUnitException;
use PHPUnit\Framework\TestCase;
use UnexpectedValueException;

class UsersAdapterTest extends TestCase
{
    /**
     * @throws PHPUnitException
     */
    public function testShouldGetUsers()
    {
        $mockedRawJson = '[{
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
        }]';
        $mockedHttpResponse = $this->createMock(IHttpResponse::class);
        $mockedHttpResponse->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(200);
        $mockedHttpResponse->expects($this->once())
            ->method('getBody')
            ->willReturn($mockedRawJson);
        $mockedHttpClient = $this->createMock(IHttpClient::class);
        $mockedHttpClient->expects($this->once())
            ->method('get')
            ->willReturn($mockedHttpResponse);
        $adapter = new UserAdapter($mockedHttpClient);
        $result = $adapter->getUsers();
        $this->assertCount(1, $result);
        $this->assertInstanceOf(UserEntity::class, $result->first());
    }

    /**
     * @throws PHPUnitException
     */
    public function testShouldThrowAnExceptionWhenHttpClientReturnNotSuccessStatusCode()
    {
        $mockedHttpResponse = $this->createMock(IHttpResponse::class);
        $mockedHttpResponse->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(400);
        $mockedHttpResponse->expects($this->never())
            ->method('getBody');
        $mockedHttpClient = $this->createMock(IHttpClient::class);
        $mockedHttpClient->expects($this->once())
            ->method('get')
            ->willReturn($mockedHttpResponse);
        $adapter = new UserAdapter($mockedHttpClient);
        $this->expectException(UnexpectedValueException::class);
        $adapter->getUsers();
    }
}
