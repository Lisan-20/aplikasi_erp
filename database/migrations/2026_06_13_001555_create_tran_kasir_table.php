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
        if (Schema::hasTable('tran_kasir')) {
            return;
        }

        Schema::create('tran_kasir', function (Blueprint $table) {
            $table->increments('kode_tran_kasir');
            $table->integer('kode_tc_trans_kasir')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->string('seri_kuitansi', 20)->nullable();
            $table->string('no_induk', 20)->nullable();
            $table->dateTime('tgl_jam')->nullable();
            $table->decimal('jumlah_old', 18, 0)->nullable();
            $table->string('kode_bagian', 10)->nullable();
            $table->integer('flag_jurnal')->nullable();
            $table->dateTime('tgl_proses')->nullable();
            $table->integer('kode')->nullable();
            $table->string('kode_perusahaan', 10)->nullable();
            $table->decimal('jumlah', 18)->nullable();
            $table->integer('npp')->nullable();
            $table->integer('kode_inap')->nullable();
            $table->bigInteger('no_kuitansi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tran_kasir');
    }
};
