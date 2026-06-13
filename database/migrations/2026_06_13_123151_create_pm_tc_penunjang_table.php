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
        Schema::create('pm_tc_penunjang', function (Blueprint $table) {
            $table->increments('id_pm_tc_penunjang');
            $table->integer('kode_penunjang');
            $table->dateTime('tgl_daftar')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->integer('no_antrian')->nullable();
            $table->integer('no_foto')->nullable();
            $table->string('dr_pengirim', 50)->nullable();
            $table->integer('petugas_input')->nullable();
            $table->integer('status_daftar')->nullable();
            $table->integer('radiografer')->nullable();
            $table->dateTime('tgl_isihasil')->nullable();
            $table->integer('petugas_isihasil')->nullable();
            $table->string('catatan_hasil_1', 50)->nullable();
            $table->integer('status_isihasil')->nullable();
            $table->integer('kode_klas')->nullable();
            $table->string('no_hasil_pm2', 50)->nullable();
            $table->integer('status_bayar')->nullable();
            $table->string('asal_daftar', 50)->nullable();
            $table->integer('status_batal')->nullable();
            $table->integer('flag_man')->nullable();
            $table->integer('kode_dr_pengirim')->nullable();
            $table->integer('flag_mandiri')->nullable();
            $table->string('no_radio', 10)->nullable();
            $table->integer('kd_dr_pengirim')->nullable();
            $table->string('diagnosa', 10)->nullable();
            $table->dateTime('waktu_sampel')->nullable();
            $table->integer('no_hasil_pmx')->nullable();
            $table->text('catatan_hasil')->nullable();
            $table->text('ket_pm')->nullable();
            $table->bigInteger('no_hasil_pm')->nullable();
            $table->integer('flag_lis')->nullable();

            $table->primary(['kode_penunjang'], 'pk_pm_tc_penunjang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_tc_penunjang');
    }
};
