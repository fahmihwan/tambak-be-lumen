<?php

use App\Models\Kolam;
use App\Models\StokPakan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputPakanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_pakan', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Kolam::class);
            $table->foreignIdFor(StokPakan::class);
            $table->date('tgl');
            $table->time('waktu');
            $table->integer('jumlah');
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
        Schema::dropIfExists('input_pakan');
    }
}
