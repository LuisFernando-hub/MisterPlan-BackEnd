<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $checkIn = fake()->dateTimeBetween('+1 day', '+30 days');
        $checkOut = (clone $checkIn)->modify('+'.rand(1, 10).' days');

        return [
            'guest_name' => fake()->name(),
            'guest_email' => fake()->safeEmail(),
            'property_name' => fake()->randomElement([
                'Batumi Apartment',
                'Sea View Hotel',
                'Mountain House',
                'Downtown Studio',
            ]),
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'status' => fake()->randomElement([
                'pending',
                'confirmed',
                'cancelled',
            ]),
            'amount' => fake()->randomFloat(2, 100, 3000),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
