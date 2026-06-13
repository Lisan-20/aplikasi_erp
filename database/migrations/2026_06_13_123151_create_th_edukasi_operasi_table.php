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
        Schema::create('th_edukasi_operasi', function (Blueprint $table) {
            $table->increments('id_edukasi_operasi');
            $table->dateTime('tgl_edukasi')->nullable();
            $table->string('hari', 10)->nullable();
            $table->string('nama_pasien', 50)->nullable();
            $table->dateTime('tgl_lahir_pasien')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->integer('no_mr')->nullable();
            $table->string('dr_anestesi', 50)->nullable();
            $table->string('dr_operator', 50)->nullable();
            $table->text('tindakan')->nullable();
            $table->string('nutrisi', 8)->nullable();
            $table->string('nutrisi_po', 8)->nullable();
            $table->string('nutrisi_ruang', 8)->nullable();
            $table->string('nutrisi_rmh', 8)->nullable();
            $table->string('keamanan', 8)->nullable();
            $table->string('keamanan_po', 8)->nullable();
            $table->string('keamanan_ruang', 8)->nullable();
            $table->string('keamanan_rmh', 8)->nullable();
            $table->string('kebersihan', 8)->nullable();
            $table->string('kebersihan_po', 8)->nullable();
            $table->string('kebersihan_ruang', 8)->nullable();
            $table->string('kebersihan_rmh', 8)->nullable();
            $table->string('kebersihan_mandi_pas', 8)->nullable();
            $table->string('disiplin_obt', 8)->nullable();
            $table->char('analgetik', 10)->nullable();
            $table->string('saksi', 50)->nullable();
            $table->string('hub_kel', 50)->nullable();
            $table->string('Pernyataan', 20)->nullable();
            $table->integer('kode_petugas_edukasi')->nullable();
            $table->string('alamat_pas', 50)->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_edukasi_operasi');
    }
};
