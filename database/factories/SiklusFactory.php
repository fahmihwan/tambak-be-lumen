<?php

namespace Database\Factories;

use App\Models\Siklus;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiklusFactory extends Factory
{
    protected $model = Siklus::class;

    public function definition(): array
    {
        return [
            'kolam_id' => rand(1, 10),
            'tgl_tebar' => date('Y-m-d'),
            'total_tebar' => rand(1000, 1200),
            'perhitungan' => 'Netto',
            'spesies_udang' => 'Udang Tambak',
            'umur_awal_udang' => rand(30, 50),
            'target_sr' => rand(60, 100),
            'lama_budidaya' => 0,
            'note' => $this->faker->paragraph()
        ];
    }
}
