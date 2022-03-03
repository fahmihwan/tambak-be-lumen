<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTambakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tambak', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('negara');
            $table->string('alamat', 255);
            $table->integer('jumlah_kolam');
            $table->string('zona_waktu');
            $table->string('nama_awal_kolam');
            $table->integer('luas');
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
        Schema::dropIfExists('tambak');
    }
}
