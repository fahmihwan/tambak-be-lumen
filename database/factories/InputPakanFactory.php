<?php

namespace Database\Factories;

use App\Models\InputPakan;
use Illuminate\Database\Eloquent\Factories\Factory;

class InputPakanFactory extends Factory
{
    protected $model = InputPakan::class;

    public function definition(): array
    {
        return [
            'kolam_id' => rand(1, 10),
            'stok_pakan_id' => rand(1, 7),
            'tgl' => date('Y-m-d'),
            'waktu' => date('H:i:s'),
            'jumlah' => rand(10, 20),
            'note' => $this->faker->paragraph()
        ];
    }
}
