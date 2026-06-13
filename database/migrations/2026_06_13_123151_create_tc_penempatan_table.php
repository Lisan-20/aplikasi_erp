<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tc_penempatan', function (Blueprint $table) {
            $table->increments('id_tc_penempatan');
            $table->string('npp', 10)->nullable();
            $table->integer('id_kd_penempatan')->nullable();
            $table->string('kode_bagian_asal', 18)->nullable();
            $table->string('kode_bagian_baru', 18)->nullable();
            $table->dateTime('tgl_mulai')->nullable();
            $table->dateTime('tgl_akhir')->nullable();
            $table->string('keterangan', 50)->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('st_penempatan')->nullable();
            $table->string('no_sk', 50)->nullable();
            $table->dateTime('tgl_sk')->nullable();
            $table->integer('id_jabatan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_penempatan');
    }
};
