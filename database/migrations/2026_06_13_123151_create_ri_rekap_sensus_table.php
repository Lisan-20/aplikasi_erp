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
        if (Schema::hasTable('ri_rekap_sensus')) {
            return;
        }

        Schema::create('ri_rekap_sensus', function (Blueprint $table) {
            $table->dateTime('tgl_input')->nullable();
            $table->integer('tgl')->nullable();
            $table->integer('bln')->nullable();
            $table->integer('thn')->nullable();
            $table->integer('awal')->nullable();
            $table->integer('masuk_umum')->nullable();
            $table->integer('masuk_pindah')->nullable();
            $table->integer('masuk_jml')->nullable();
            $table->integer('keluar_hidup')->nullable();
            $table->integer('keluar_mati')->nullable();
            $table->integer('keluar_pindah')->nullable();
            $table->integer('keluar_jml')->nullable();
            $table->integer('sisa')->nullable();
            $table->integer('kelas_vip')->nullable();
            $table->integer('kelas_i')->nullable();
            $table->integer('kelas_ii')->nullable();
            $table->integer('kelas_iii')->nullable();
            $table->integer('masuk_kelas_vip')->nullable();
            $table->integer('masuk_kelas_i')->nullable();
            $table->integer('masuk_kelas_ii')->nullable();
            $table->integer('masuk_kelas_iii')->nullable();
            $table->integer('keluar_kelas_vip')->nullable();
            $table->integer('keluar_kelas_i')->nullable();
            $table->integer('keluar_kelas_ii')->nullable();
            $table->integer('keluar_kelas_iii')->nullable();
            $table->string('kode_bagian', 6);
            $table->tinyInteger('status_konsolidasi')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ri_rekap_sensus');
    }
};
