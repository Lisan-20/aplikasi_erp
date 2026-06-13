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
        if (Schema::hasTable('tc_penerimaan_instalasi_detail')) {
            return;
        }

        Schema::create('tc_penerimaan_instalasi_detail', function (Blueprint $table) {
            $table->increments('id_penerimaan_instalasi_detail');
            $table->string('kode_brg', 10)->nullable();
            $table->string('kode_bagian', 10)->nullable();
            $table->integer('jumlah')->nullable();
            $table->dateTime('tanggal_penerimaan')->nullable()->useCurrent();
            $table->integer('id_permintaan_instalasi_detail')->nullable();
            $table->string('kode_permintaan_instalasi', 20)->nullable();
            $table->string('petugas', 20)->nullable();

            $table->primary(['id_penerimaan_instalasi_detail'], 'pk_tc_penerimaan_instalasi_detail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_penerimaan_instalasi_detail');
    }
};
