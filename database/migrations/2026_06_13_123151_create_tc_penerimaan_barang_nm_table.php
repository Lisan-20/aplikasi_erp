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
        Schema::create('tc_penerimaan_barang_nm', function (Blueprint $table) {
            $table->string('kode_penerimaan', 20);
            $table->string('no_po', 20)->nullable();
            $table->dateTime('tgl_penerimaan')->nullable();
            $table->integer('kodesupplier')->nullable();
            $table->string('petugas', 20)->nullable();
            $table->integer('tipe_lpb')->nullable()->default(0);
            $table->string('keterangan')->nullable();
            $table->string('no_faktur', 20)->nullable();
            $table->string('diketahui', 20)->nullable();
            $table->string('dikirim', 20)->nullable();
            $table->string('disetujui', 20)->nullable();
            $table->integer('status_invoice')->nullable()->default(0);
            $table->tinyInteger('flag_hutang')->nullable();
            $table->tinyInteger('flag_jurnal')->nullable();
            $table->increments('id_tc_penerimaan_brg_nm');
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('status_ver')->nullable();
            $table->integer('no_urut_periodik')->nullable();
            $table->integer('id_trans_umd')->nullable();

            $table->primary(['id_tc_penerimaan_brg_nm'], 'pk_tc_penerimaan_barang_nm_1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_penerimaan_barang_nm');
    }
};
