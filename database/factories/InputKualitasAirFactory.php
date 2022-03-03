<?php

namespace Database\Factories;

use App\Models\InputKualitasAir;
use Illuminate\Database\Eloquent\Factories\Factory;

class InputKualitasAirFactory extends Factory
{
    protected $model = InputKualitasAir::class;

    public function definition(): array
    {
        return [
            'kolam_id' => rand(1, 10),
            'suhu_kolam' => rand(20, 30),
            'tgl' => date('Y-m-d'),
            'waktu' => date('H:i:s'),
            'note' => $this->faker->paragraph
        ];
    }
}
