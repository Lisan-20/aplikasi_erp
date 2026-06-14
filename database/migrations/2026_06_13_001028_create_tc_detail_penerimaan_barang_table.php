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
        if (Schema::hasTable('tc_detail_penerimaan_barang')) {
            return;
        }

        Schema::create('tc_detail_penerimaan_barang', function (Blueprint $table) {
            $table->string('kode_detail_penerimaan_barang', 18);
            $table->string('kode_brg', 20)->nullable();
            $table->string('kode_penerimaan', 20)->nullable();
            $table->integer('jumlah_pesan')->nullable();
            $table->integer('jumlah_kirim')->nullable();
            $table->integer('bonus_pesan')->nullable();
            $table->integer('bonus_kirim')->nullable();
            $table->integer('bonus_kurang')->nullable();
            $table->integer('content')->nullable();
            $table->string('keterangan', 20)->nullable();
            $table->dateTime('tgl_kadaluarsa')->nullable();

            $table->primary(['kode_detail_penerimaan_barang'], 'pk__tc_detail_peneri__5c986ab7');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_detail_penerimaan_barang');
    }
};
