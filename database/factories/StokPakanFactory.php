<?php

namespace Database\Factories;

use App\Models\StokPakan;
use Illuminate\Database\Eloquent\Factories\Factory;

class StokPakanFactory extends Factory
{
    protected $model = StokPakan::class;

    public function definition(): array
    {
        return [
            'nama' => $this->faker->name,
            'total_berat' => rand(20, 100),
            'harga' => rand(100000, 1000000),
            'tgl_beli' => date('Y-m-d'),
            'tgl_expired' => date('Y-m-d'),
            'note' => $this->faker->paragraph()
        ];
    }
}
