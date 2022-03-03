<?php

namespace Database\Factories;

use App\Models\InputSampling;
use Illuminate\Database\Eloquent\Factories\Factory;

class InputSamplingFactory extends Factory
{
    protected $model = InputSampling::class;

    public function definition(): array
    {
        return [
            'kolam_id' => rand(1, 10),
            'tgl' => date('Y-m-d'),
            'waktu' => date('H:i:s'),
            'berat_udang' => rand(10, 20),
            'note' => $this->faker->paragraph()
        ];
    }
}
