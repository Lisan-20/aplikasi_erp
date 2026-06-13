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
        Schema::create('tc_penerimaan_rekanan_detail', function (Blueprint $table) {
            $table->increments('id_tc_penerimaan_rekanan_detail');
            $table->integer('id_tc_penerimaan_rekanan')->nullable();
            $table->string('kode_brg', 10)->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->integer('jumlah')->nullable();
            $table->dateTime('tanggal_penerimaan')->nullable()->useCurrent();
            $table->integer('id_tc_permintaan_rekanan_det')->nullable();
            $table->integer('id_tc_permintaan_rekanan')->nullable();
            $table->string('petugas', 20)->nullable();
            $table->string('nomor_permintaan', 50)->nullable();
            $table->decimal('harga_persediaan', 18)->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('status_ver')->nullable();

            $table->primary(['id_tc_penerimaan_rekanan_detail'], 'pk_tc_penerimaan_rekanan_detail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_penerimaan_rekanan_detail');
    }
};
