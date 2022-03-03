<?php

use App\Models\Kolam;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputSamplingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_sampling', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Kolam::class);
            $table->date('tgl');
            $table->time('waktu');
            $table->integer('berat_udang');
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
        Schema::dropIfExists('input_sampling');
    }
}
