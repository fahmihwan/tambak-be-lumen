<?php

use App\Models\Kolam;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiklusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siklus', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Kolam::class);
            $table->date('tgl_tebar');
            $table->integer('total_tebar');
            $table->string('perhitungan');
            $table->string('spesies_udang');
            $table->integer('umur_awal_udang');
            $table->integer('target_sr');
            $table->integer('lama_budidaya');
            $table->text('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siklus');
    }
}
