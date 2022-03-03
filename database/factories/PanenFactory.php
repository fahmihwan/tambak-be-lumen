<?php

namespace Database\Factories;

use App\Models\Panen;
use Illuminate\Database\Eloquent\Factories\Factory;

class PanenFactory extends Factory
{
    protected $model = Panen::class;

    public function definition(): array
    {
        return [
            'siklus_id' => 1,
            'tgl' => date('Y-m-d'),
            'total' => rand(20, 100),
            'jml_udang' => rand(400, 1000),
            'harga_jual' => rand(500000, 1000000),
            'status' => 'parsial',
            'note' => $this->faker->paragraph()
        ];
    }
}
