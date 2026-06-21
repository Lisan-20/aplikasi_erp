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
        if (Schema::hasTable('tc_penerimaan_retur')) {
            return;
        }

        Schema::create('tc_penerimaan_retur', function (Blueprint $table) {
            $table->increments('id_tc_pen_retur');
            $table->string('kode_brg', 50)->nullable();
            $table->integer('id_tc_retur_supplier')->nullable();
            $table->decimal('jumlah_pesan', 19, 4)->nullable();
            $table->decimal('jumlah_kirim', 19, 4)->nullable();
            $table->decimal('jumlah_kurang', 19, 4)->nullable();
            $table->string('keterangan')->nullable();
            $table->dateTime('tgl_kadaluarsa')->nullable();
            $table->string('kode_brg_ganti', 50)->nullable();
            $table->decimal('jumlah_kirim_ganti', 19, 4)->nullable();
            $table->decimal('ganti_uang', 19, 4)->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('jns_penerimaan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_penerimaan_retur');
    }
};
