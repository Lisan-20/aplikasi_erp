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
        Schema::create('lap_sensus_rm_temp', function (Blueprint $table) {
            $table->integer('id_lap_sensus_rm')->nullable();
            $table->integer('pasien_awal')->nullable();
            $table->integer('pasien_masuk')->nullable();
            $table->integer('pasien_pindahan')->nullable();
            $table->integer('pasien_dipindahkan')->nullable();
            $table->integer('pasien_keluar_hidup')->nullable();
            $table->integer('kurang_48jam')->nullable();
            $table->integer('lebih_48jam')->nullable();
            $table->integer('lama_dirawat')->nullable();
            $table->integer('pasien_keluar_masuk')->nullable();
            $table->integer('pasien_sisa')->nullable();
            $table->integer('kelas_vip')->nullable();
            $table->integer('kelas_1')->nullable();
            $table->integer('kelas_2')->nullable();
            $table->integer('kelas_3a')->nullable();
            $table->integer('kelas_3b')->nullable();
            $table->date('date')->nullable();
            $table->string('bagian', 50)->nullable();
            $table->integer('tglnnya')->nullable();
            $table->integer('blnnya')->nullable();
            $table->integer('thnnya')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lap_sensus_rm_temp');
    }
};
