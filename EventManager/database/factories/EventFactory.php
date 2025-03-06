<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        $start = $this->faker->dateTimeBetween('now', '+1 month');
        $end = (clone $start)->modify('+2 hours');

        return [
            'title'          => $this->faker->sentence(3),
            'description'    => $this->faker->paragraph,
            'start_datetime' => $start,
            'end_datetime'   => $end,
            'location'       => $this->faker->address,
            'capacity'       => $this->faker->numberBetween(50, 500),
            'status'         => 'aberto',
        ];
    }
}
