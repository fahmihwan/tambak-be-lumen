<?php

namespace Database\Factories;

use App\Models\Kolam;
use Illuminate\Database\Eloquent\Factories\Factory;

class KolamFactory extends Factory
{
    protected $model = Kolam::class;

    public function definition(): array
    {
        return [
            'tambak_id' => rand(1, 10),
            'nama' => $this->faker->name,
            'luas' => rand(10, 20)
        ];
    }
}
