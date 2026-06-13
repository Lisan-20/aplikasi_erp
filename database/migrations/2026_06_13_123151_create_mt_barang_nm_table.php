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
        Schema::create('mt_barang_nm', function (Blueprint $table) {
            $table->string('kode_brg', 20);
            $table->string('kode_pabrik', 20)->nullable();
            $table->string('kode_generik', 20)->nullable();
            $table->string('nama_brg', 200)->nullable();
            $table->string('kode_kategori', 20)->nullable();
            $table->string('satuan_besar', 20)->nullable();
            $table->string('satuan_kecil', 20)->nullable();
            $table->integer('flag_medis')->nullable();
            $table->integer('jenis_obat')->nullable();
            $table->integer('jenis_askes')->nullable();
            $table->string('kode_sub_golongan', 50)->nullable();
            $table->string('kode_golongan', 50)->nullable();
            $table->integer('id_pabrik')->nullable();
            $table->string('kode_layanan', 50)->nullable();
            $table->integer('obat_khusus')->nullable();
            $table->integer('kode_jenis')->nullable();
            $table->integer('content')->nullable();
            $table->integer('id_barang');
            $table->string('type', 200)->nullable();
            $table->string('merk', 100)->nullable();
            $table->string('buatan', 100)->nullable();
            $table->integer('flag_asset')->nullable();
            $table->string('inv', 50)->nullable();
            $table->string('supplier', 50)->nullable();
            $table->string('sn', 50)->nullable();
            $table->string('cp', 50)->nullable();
            $table->date('tglbeli')->nullable();
            $table->decimal('harga_beli', 19, 4)->nullable();
            $table->integer('flag_jenis')->nullable();
            $table->string('kode_brg_medis', 50)->nullable();
            $table->integer('inv_tehnik')->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_barang_nm');
    }
};
