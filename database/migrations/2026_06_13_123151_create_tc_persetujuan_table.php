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
        Schema::create('tc_persetujuan', function (Blueprint $table) {
            $table->increments('id_persetujuan');
            $table->string('no_mr', 8)->nullable();
            $table->string('no_registrasi', 15)->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->string('nama_pj', 50)->nullable();
            $table->string('umur_pj', 50)->nullable();
            $table->string('hub_pj', 50)->nullable();
            $table->text('tindakan')->nullable();
            $table->string('saksi1', 50)->nullable();
            $table->string('saksi2', 50)->nullable();
            $table->string('nama_pasien', 50)->nullable();
            $table->text('alamat')->nullable();
            $table->string('umur', 50)->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('id_user')->nullable();
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
        Schema::dropIfExists('tc_persetujuan');
    }
};
