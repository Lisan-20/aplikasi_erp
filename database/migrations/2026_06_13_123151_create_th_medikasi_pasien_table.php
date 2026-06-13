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
        Schema::create('th_medikasi_pasien', function (Blueprint $table) {
            $table->increments('kode_id');
            $table->dateTime('tgl_jam')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->bigInteger('no_registrasi')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->string('no_kunjungan', 50)->nullable();
            $table->string('cara', 50)->nullable();
            $table->text('obat_medikasi')->nullable();
            $table->string('dosis', 50)->nullable();
            $table->integer('kode_riwayat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_medikasi_pasien');
    }
};
