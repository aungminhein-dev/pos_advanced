<?php

namespace Database\Factories;

use App\Models\DeliveryLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DeliveryLocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = DeliveryLocation::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->city,
            'price' => 3000,
            'status' => 1,
            'gate_fee_status' => 0,
            'gate_fee' => 0,
        ];
    }
}
