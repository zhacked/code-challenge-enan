<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_list_returns_correct_structure()
    {
        // Arrange: Create 3 customers
        Customer::factory()->count(3)->create();

        // Act: Hit the API
        $response = $this->getJson('/api/customers');

        // Assert: Check response structure
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [ // Each item in the collection
                        'full_name',
                        'email',
                        'username',
                        'gender',
                        'country',
                        'city',
                        'phone',
                    ]
                ]
            ]);
    }

    public function test_show_customer_returns_404_when_not_found()
    {
        $nonExistingId = Customer::max('id') + 100; // make sure it doesn’t collide with real data

        $response = $this->getJson("/api/customers/{$nonExistingId}");

        $response->assertStatus(404);
    }

    public function test_show_customer_returns_data()
    {
        $customer = Customer::factory()->create();

        $response = $this->getJson("/api/customers/{$customer->id}");

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'full_name' => "{$customer->first_name} {$customer->last_name}",
                    'email' => $customer->email,
                    'username' => $customer->username,
                    'gender' => $customer->gender,
                    'country' => $customer->country,
                    'city' => $customer->city,
                    'phone' => $customer->phone,
                ]
            ]);
    }
}
