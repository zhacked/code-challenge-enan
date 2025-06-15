<?php

namespace Tests\Unit;

use App\Models\Customer;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;
use App\Services\CustomerImporterService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Providers\RandomUserApiService;


class CustomerImporterServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_imports_customers_successfully()
    {
        $mockedData = [
            [
                'email' => 'john@example.com',
                'name' => [
                    'first' => 'John',
                    'last' => 'Doe'
                ],
                'login' => [
                    'username' => 'johndoe',
                    'password' => 'password123'
                ],
                'gender' => 'male',
                'location' => [
                    'country' => 'Australia',
                    'city' => 'Sydney'
                ],
                'phone' => '1234567890',
            ]
        ];

        $mockApi = $this->createMock(RandomUserApiService::class);
        $mockApi->method('fetch')->willReturn($mockedData);

        $service = new CustomerImporterService($mockApi);

        $importedCount = $service->import();

        $this->assertEquals(1, $importedCount);

        $this->assertDatabaseHas('customers', [
            'email' => 'john@example.com',
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);
    }

    public function test_random_user_service_handles_empty_data()
    {
        Http::fake([
            'https://randomuser.me/*' => Http::response(['results' => []], 200),
        ]);

        $service = new RandomUserApiService();

        $results = $service->fetch();

        $this->assertEmpty($results);
    }
}
