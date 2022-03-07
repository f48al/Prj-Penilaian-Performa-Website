<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DraftKpiIndividuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'indikatorKunciKerja'   => $this->faker->sentence(),
            'perspektif'            => $this->faker->sentence(),
            'tujuanStrategis'       => $this->faker->sentence(),
            'skala'                 => $this->faker->numberBetween(1, 10),
            'bobot'                 => $this->faker->numberBetween(1, 10),
            'glosary'               => $this->faker->sentence(),
            'formula'               => $this->faker->sentence(),
            'targetTriwulan1'       => $this->faker->numberBetween(1, 10),
            'targetTriwulan2'       => $this->faker->numberBetween(1, 10),
            'targetTriwulan3'       => $this->faker->numberBetween(1, 10),
            'targetTriwulan4'       => $this->faker->numberBetween(1, 10),
            'tahunKinerja'          => $this->faker->numberBetween(2017, intval(date('Y'))),
            'created_at'            => $this->faker->dateTimeBetween('-1 years', 'now'),
        ];
    }
}
