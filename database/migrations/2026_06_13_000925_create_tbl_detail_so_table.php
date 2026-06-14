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
        if (Schema::hasTable('tbl_detail_so')) {
            return;
        }

        Schema::create('tbl_detail_so', function (Blueprint $table) {
            $table->increments('id_tbl_det_so');
            $table->string('kode_brg', 20)->nullable();
            $table->string('satuan_kecil', 10)->nullable();
            $table->string('satuan_besar', 10)->nullable();
            $table->decimal('stok_sistem', 18)->nullable();
            $table->decimal('so', 18)->nullable();
            $table->string('kode_bagian', 18)->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->decimal('harga_satuan', 19, 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_detail_so');
    }
};
