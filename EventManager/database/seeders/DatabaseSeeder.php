<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;
use App\Models\Registration;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory()->admin()->create([
            'name'  => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        User::factory(10)->create();

        $events = Event::factory(5)->create();

        foreach ($events as $event) {
            $count = rand(0, 5);

            $participants = User::where('role', 'participant')
                ->inRandomOrder()
                ->take($count)
                ->get();

            foreach ($participants as $participant) {
                Registration::factory()->create([
                    'event_id' => $event->id,
                    'user_id'  => $participant->id,
                ]);
            }
        }
    }
}
