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
        Schema::create('tc_penggunaan_obat_ri', function (Blueprint $table) {
            $table->increments('id_penggunaan');
            $table->dateTime('tgl_penggunaan')->nullable();
            $table->integer('id_user')->nullable();
            $table->text('ttd')->nullable();
            $table->string('ttd_nama', 50)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->string('no_mr', 50)->nullable();
            $table->dateTime('tgl_ttd')->nullable();
            $table->string('telpon_pasien', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_penggunaan_obat_ri');
    }
};
