<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hari_jam_kerja', function (Blueprint $table) {
            $table->id();
            $table->integer('hari_id'); // 1 : senin
            $table->string('nama_hari');

            $table->time('jam_masuk_start');
            // $table->time('jam_masuk');
            $table->time('jam_masuk_end');

            $table->time('jam_keluar_start');
            // $table->time('jam_keluar');
            $table->time('jam_keluar_end');

            $table->boolean('libur')->default(false)->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('hari_jam_kerja');
    }
};
