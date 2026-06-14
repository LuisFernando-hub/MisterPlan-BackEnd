<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reservation::factory()
            ->count(20)
            ->create()
            ->each(function ($reservation) {

                $reservation->events()->create([
                    'type' => 'created',
                    'description' => 'Reservation created',
                ]);

                if ($reservation->status === 'confirmed') {
                    $reservation->events()->create([
                        'type' => 'updated',
                        'description' => 'Reservation confirmed',
                    ]);
                }

                if ($reservation->status === 'cancelled') {
                    $reservation->events()->create([
                        'type' => 'updated',
                        'description' => 'Reservation cancelled',
                    ]);
                }

                $extraEvents = rand(0, 3);

                for ($i = 0; $i < $extraEvents; $i++) {
                    $reservation->events()->create([
                        'type' => fake()->randomElement([
                            'created',
                            'updated',
                        ]),
                        'description' => fake()->sentence(),
                    ]);
                }
        });
    }
}
