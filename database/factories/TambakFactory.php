<?php

namespace Database\Factories;

use App\Models\Tambak;
use Illuminate\Database\Eloquent\Factories\Factory;

class TambakFactory extends Factory
{
    protected $model = Tambak::class;

    public function definition(): array
    {
        return [
            'nama' => $this->faker->name,
            'negara' => $this->faker->country,
            'alamat' => $this->faker->address,
            'jumlah_kolam' => 0,
            'zona_waktu' => 'UTC',
            'nama_awal_kolam' => $this->faker->name,
            'luas' => rand(20, 100)
        ];
    }
}
