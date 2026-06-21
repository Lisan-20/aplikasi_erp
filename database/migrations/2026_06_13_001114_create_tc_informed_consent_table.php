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
        if (Schema::hasTable('tc_informed_consent')) {
            return;
        }

        Schema::create('tc_informed_consent', function (Blueprint $table) {
            $table->increments('id_info');
            $table->integer('no_kunjungan')->nullable();
            $table->string('no_registrasi', 50)->nullable();
            $table->integer('kd_dokter_tind')->nullable();
            $table->string('pem_info', 250)->nullable();
            $table->string('pen_info', 250)->nullable();
            $table->string('nama', 250)->nullable();
            $table->string('alamat', 250)->nullable();
            $table->dateTime('tgl_lahir')->nullable();
            $table->integer('sex')->nullable();
            $table->integer('id_persetujuan')->nullable();
            $table->text('txt_diagnosis')->nullable();
            $table->text('txt_dasar_diagnosis')->nullable();
            $table->text('txt_tind_dokter')->nullable();
            $table->text('txt_indikasi')->nullable();
            $table->text('txt_terapi')->nullable();
            $table->text('txt_cara')->nullable();
            $table->text('txt_tujuan')->nullable();
            $table->text('txt_resiko')->nullable();
            $table->text('txt_komplikasi')->nullable();
            $table->text('txt_alternatif')->nullable();
            $table->text('txt_rencana')->nullable();
            $table->text('txt_hal_lain')->nullable();
            $table->dateTime('txt_tgl')->nullable();
            $table->text('saksi1')->nullable();
            $table->text('saksi2')->nullable();
            $table->string('no_mr', 50)->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->text('txt_nama_tindakan')->nullable();
            $table->text('txt_prognosis')->nullable();
            $table->text('ttd_pernyataan')->nullable();
            $table->text('ttd_saksi1')->nullable();
            $table->text('ttd_saksi2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_informed_consent');
    }
};
