<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InboxFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 4),
            'jenis' => $this->faker->randomElement(['Draft Review Penilaian', 'Draft Penilaian Bawahan']),
            'jumlah' => $this->faker->numberBetween(1, 10),
            'tanggal' => $this->faker->dateTimeBetween('-4 days', 'now'),
        ];
    }
}
