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
        if (Schema::hasTable('tc_fee_dokter_man')) {
            return;
        }

        Schema::create('tc_fee_dokter_man', function (Blueprint $table) {
            $table->integer('id_fee_dr_man')->nullable();
            $table->integer('kode_dr')->nullable();
            $table->decimal('jumlah', 19, 4)->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->string('seri_kuitansi', 6)->nullable();
            $table->integer('no_kuitansi')->nullable();
            $table->dateTime('tgl_transaksi')->nullable();
            $table->dateTime('tgl_kuitansi')->nullable();
            $table->string('nama_tindakan')->nullable();
            $table->integer('flag_dr')->nullable();
            $table->string('nama_pasien')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_fee_dokter_man');
    }
};
