<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Venue;
use App\Models\Event;
use App\Models\Ticket;
use Faker\Factory as Faker;



class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Seed Users
        $users = User::factory(10)->create();

        // Seed Venues
        $venues = collect();
        for ($i = 0; $i < 3; $i++) {
            $venues->push(Venue::create([
                'name' => $faker->company(),
                'location' => $faker->address(),
                'capacity' => $faker->numberBetween(50, 200),
            ]));
        }

        // Seed Events
        $events = collect();
        for ($i = 0; $i < 5; $i++) {
            $events->push(Event::create([
                'name' => ucfirst($faker->word()) . ' Event',
                'user_id' => $users->random()->id,
                'date' => $faker->dateTimeBetween('now', '+30 days'),
                'price' => $faker->numberBetween(50, 200),
                'venue_id' => $venues->random()->id,
            ]));
        }

        // Seed Tickets
        for ($i = 0; $i < 10; $i++) {
            Ticket::create([
                'user_id' => $users->random()->id,
                'event_id' => $events->random()->id,
                'price' => $faker->randomFloat(2, 10, 100),
                'seat_number' => $faker->numberBetween(1, 100),
                'booked_at' => $faker->dateTimeBetween('-10 days', 'now'),
            ]);
        }
    }

}
