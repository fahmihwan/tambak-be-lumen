<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStokPakanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stok_pakan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('total_berat');
            $table->integer('harga');
            $table->date('tgl_beli');
            $table->date('tgl_expired');
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
        Schema::dropIfExists('stok_pakan');
    }
}
