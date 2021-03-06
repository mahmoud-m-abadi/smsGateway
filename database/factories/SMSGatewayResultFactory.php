<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SMSGatewayResult>
 */
class SMSGatewayResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'to' => $this->faker->phoneNumber,
            'provider' => $this->faker->company,
            'result' => ['status' => 200, 'message' => 'sent successfully'],
            'status_code' => 200
        ];
    }
}
