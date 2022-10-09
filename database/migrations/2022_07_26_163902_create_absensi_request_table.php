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
        Schema::create('absensi_request', function (Blueprint $table) {
            $table->id();
            $table->integer('pegawai_id');
            $table->integer('bidang_id');
            $table->enum('type', ['izin', 'sakit', 'cuti', 'dinas_luar']);

            $table->date('request_date');
            $table->text('keterangan')->nullable();
            $table->boolean('approval')->nullable();
            $table->text('alasan_penolakan')->nullable();
            $table->string('attachment_file')->nullable();
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
        Schema::dropIfExists('absensi_request');
    }
};
