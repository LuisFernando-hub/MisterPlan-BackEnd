<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\ReservationEvents;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ReservationEvents>
 */
class ReservationEventsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement([
            'guest_name',
            'guest_email',
            'property_name',
            'check_in',
            'check_out',
            'status',
            'amount',
            'notes',
        ]);

        [$oldValue, $newValue] = match ($type) {
            'guest_name'    => [fake()->name(), fake()->name()],
            'guest_email'   => [fake()->safeEmail(), fake()->safeEmail()],
            'property_name' => [fake()->word() . ' Hotel', fake()->word() . ' Resort'],
            'check_in'      => [fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d'), fake()->dateTimeBetween('now', '+1 month')->format('Y-m-d')],
            'check_out'     => [fake()->dateTimeBetween('+1 month', '+2 months')->format('Y-m-d'), fake()->dateTimeBetween('+2 months', '+3 months')->format('Y-m-d')],
            'status'        => [fake()->randomElement(['pending', 'confirmed']), fake()->randomElement(['cancelled', 'completed'])],
            'amount'        => [fake()->randomFloat(2, 100, 500), fake()->randomFloat(2, 500, 1000)],
            'notes'         => [null, null],
            default         => [fake()->word(), fake()->word()],
        };

        return [
            'reservation_id' => Reservation::factory(),
            'type'           => $type,
            'description'    => $this->buildDescription($type, $oldValue, $newValue),
        ];
    }

    private function buildDescription(string $field, mixed $oldValue, mixed $newValue): string {
        return match ($field) {
            'guest_name' =>
                "Guest name changed from '{$oldValue}' to '{$newValue}'",

            'guest_email' =>
                "Guest email changed from '{$oldValue}' to '{$newValue}'",

            'property_name' =>
                "Property changed from '{$oldValue}' to '{$newValue}'",

            'check_in' =>
                "Check-in changed from '{$oldValue}' to '{$newValue}'",

            'check_out' =>
                "Check-out changed from '{$oldValue}' to '{$newValue}'",

            'status' =>
                "Status changed from '{$oldValue}' to '{$newValue}'",

            'amount' =>
                "Amount changed from '{$oldValue}' to '{$newValue}'",

            'notes' =>
                "Notes updated",

            default =>
                "{$field} changed from '{$oldValue}' to '{$newValue}'",
        };
    }
}
