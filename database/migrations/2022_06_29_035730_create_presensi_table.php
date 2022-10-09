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
        Schema::create('presensi', function (Blueprint $table) {
            $table->id();
            $table->integer('pegawai_id');
            $table->integer('bidang_id');
            $table->dateTime('checked_in_at')->nullable();
            $table->double('checked_in_latitude')->nullable();
            $table->double('checked_in_longitude')->nullable();
            $table->string('checked_in_image')->nullable();

            $table->dateTime('checked_out_at')->nullable();
            $table->double('checked_out_latitude')->nullable();
            $table->double('checked_out_longitude')->nullable();
            $table->string('checked_out_image')->nullable();

            $table->enum('status', ['hadir', 'absen', 'izin', 'sakit', 'cuti', 'dinas_luar'])->nullable();
            $table->boolean('terlambat')->default('false');
            $table->boolean('cepat_pulang')->default('false');


            // $table->enum('status', ['cepatpulang', 'hadir', 'izin', 'sakit', 'cuti', 'perjalanandinas'])->nullable();


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
        Schema::dropIfExists('presensi');
    }
};
