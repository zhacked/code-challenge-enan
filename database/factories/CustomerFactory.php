<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'username' => $this->faker->userName(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'country' => 'Australia',
            'city' => $this->faker->city(),
            'phone' => $this->faker->phoneNumber(),
            'password' => md5('secret')
        ];
    }
}
