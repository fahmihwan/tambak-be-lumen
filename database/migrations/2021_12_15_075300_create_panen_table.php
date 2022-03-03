<?php

use App\Models\Kolam;
use App\Models\Siklus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panen', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Siklus::class);
            $table->date('tgl');
            $table->integer('total');
            $table->integer('jml_udang');
            $table->integer('harga_jual');
            $table->enum('status', ['parsial', 'total', 'gagal']);
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
        Schema::dropIfExists('panen');
    }
}
