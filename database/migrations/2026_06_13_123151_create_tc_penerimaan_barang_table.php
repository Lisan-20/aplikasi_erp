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
        Schema::create('tc_penerimaan_barang', function (Blueprint $table) {
            $table->string('kode_penerimaan', 50);
            $table->string('no_po', 20)->nullable();
            $table->dateTime('tgl_penerimaan')->nullable();
            $table->integer('kodesupplier')->nullable();
            $table->string('petugas', 20)->nullable();
            $table->integer('tipe_lpb')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('no_faktur', 20)->nullable();
            $table->string('diketahui', 20)->nullable();
            $table->string('dikirim', 20)->nullable();
            $table->string('disetujui', 20)->nullable();
            $table->integer('status_invoice')->nullable();
            $table->tinyInteger('flag_hutang')->nullable();
            $table->tinyInteger('flag_jurnal')->nullable();
            $table->integer('id_tc_po')->nullable();
            $table->increments('id_tc_penerimaan_brg');
            $table->decimal('diskon_total', 19, 4)->nullable();
            $table->integer('flag_r')->nullable();
            $table->integer('flag_is')->nullable();

            $table->primary(['kode_penerimaan'], 'pk_tc_penerimaan_barang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_penerimaan_barang');
    }
};
