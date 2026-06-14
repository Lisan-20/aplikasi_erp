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
        if (Schema::hasTable('tc_penggunaan_obat_ri_det')) {
            return;
        }

        Schema::create('tc_penggunaan_obat_ri_det', function (Blueprint $table) {
            $table->increments('id_penggunaan_det');
            $table->string('kode_brg', 50)->nullable();
            $table->string('nama_brg', 150)->nullable();
            $table->decimal('jumlah', 19, 4)->nullable();
            $table->integer('kd_tr_resep')->nullable();
            $table->integer('kode_trans_far')->nullable();
            $table->dateTime('waktu_pemakaian')->nullable();
            $table->integer('id_penggunaan')->nullable();
            $table->string('intruksi', 250)->nullable();
            $table->string('int_penggunaan', 250)->nullable();
            $table->string('int_waktu_pakai', 250)->nullable();
            $table->dateTime('waktu_pemakaian_lanjut')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_penggunaan_obat_ri_det');
    }
};
