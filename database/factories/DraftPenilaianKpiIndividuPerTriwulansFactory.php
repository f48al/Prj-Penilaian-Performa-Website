<?php

namespace Database\Factories;

use App\Models\DraftKpiIndividu;
use Illuminate\Database\Eloquent\Factories\Factory;

class DraftPenilaianKpiIndividuPerTriwulansFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $perspektif = ['Pertumbuhan', 'Kinerja', 'Kualitas', 'Internal Proses', 'Pelanggan'];
        $waktuTriwulan = ['I', 'II', 'III', 'IV'];

        return [
            'iddkpi'                => DraftKpiIndividu::select('iddKPI')->inRandomOrder()->first()->iddKPI,
            'waktuTriwulan'         => $waktuTriwulan[array_rand($waktuTriwulan)],
            'indikatorKunciKerja'   => $this->faker->sentence(),
            'perspektif'            => $perspektif[$this->faker->numberBetween(0, 4)],
            'tujuanStrategis'       => $this->faker->sentence(),
            'skala'                 => $this->faker->numberBetween(1, 10),
            'bobot'                 => $this->faker->numberBetween(1, 10),
            'filePendukung'         => null,
            'realisasiKaryawan'     => null,
            'realisasiAtasan'       => null,
        ];
    }
}
