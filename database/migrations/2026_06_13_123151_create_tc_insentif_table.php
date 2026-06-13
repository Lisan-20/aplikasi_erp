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
        if (Schema::hasTable('tc_insentif')) {
            return;
        }

        Schema::create('tc_insentif', function (Blueprint $table) {
            $table->increments('id_tc_insentif');
            $table->integer('kode_proses')->nullable();
            $table->dateTime('tgl_proses')->nullable();
            $table->integer('kode_klasifikasi')->nullable();
            $table->string('nama_klasifikasi')->nullable();
            $table->integer('bulan')->nullable();
            $table->integer('tahun')->nullable();
            $table->decimal('jumlah_pasien', 18)->nullable();
            $table->decimal('plafon', 18)->nullable();
            $table->decimal('fee', 18)->nullable();
            $table->integer('id_mt_kategori_ins_det')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_insentif');
    }
};
