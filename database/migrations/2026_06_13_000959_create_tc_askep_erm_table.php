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
        if (Schema::hasTable('tc_askep_erm')) {
            return;
        }

        Schema::create('tc_askep_erm', function (Blueprint $table) {
            $table->increments('id_askep_erm');
            $table->string('no_mr', 8)->nullable();
            $table->string('no_registrasi', 20)->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->string('kode_bagian', 8)->nullable();
            $table->string('kode_tarif', 20)->nullable();
            $table->string('masalah', 100)->nullable();
            $table->string('evaluasi', 100)->nullable();
            $table->string('instruksi', 100)->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('user_id')->nullable();
            $table->text('pengkajian')->nullable();
            $table->integer('kode_paramedis')->nullable();
            $table->string('Kegiatan_monitoring', 250)->nullable();
            $table->string('keterangan', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_askep_erm');
    }
};
