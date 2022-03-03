<?php

namespace Database\Seeders;

use App\Models\InputKualitasAir;
use App\Models\InputPakan;
use App\Models\InputSampling;
use App\Models\Kolam;
use App\Models\Panen;
use App\Models\Siklus;
use App\Models\StokPakan;
use App\Models\Tambak;
use Database\Factories\TambakFactory;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Input\Input;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        // Tambak::factory()->count(10)->create();
        // StokPakan::factory()->count(10)->create();
        // Kolam::factory()->count(10)->create();
        // Siklus::factory()->count(10)->create();
        // Panen::factory()->count(1)->create();
        // InputPakan::factory()->count(5)->create();
        // InputSampling::factory()->count(5)->create();
        InputKualitasAir::factory()->count(5)->create();
    }
}
