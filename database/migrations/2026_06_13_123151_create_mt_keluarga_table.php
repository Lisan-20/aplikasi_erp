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
        Schema::create('mt_keluarga', function (Blueprint $table) {
            $table->increments('no_kk');
            $table->string('nama_keluarga', 50)->nullable();
            $table->string('tmp_lahir', 50)->nullable();
            $table->dateTime('tgl_lahir')->nullable();
            $table->integer('id_dc_sex')->nullable();
            $table->integer('id_dc_pekerjaan')->nullable();
            $table->integer('id_dc_agama')->nullable();
            $table->string('alamat', 50)->nullable();
            $table->string('tlp', 50)->nullable();
            $table->integer('id_hub')->nullable();
            $table->integer('id_dc_tingkat_pnddkan')->nullable();
            $table->char('no_mr', 10)->nullable();
            $table->string('npp', 10)->nullable();
            $table->string('status_ditanggung', 1)->nullable();
            $table->integer('kode_dokter')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_keluarga');
    }
};
