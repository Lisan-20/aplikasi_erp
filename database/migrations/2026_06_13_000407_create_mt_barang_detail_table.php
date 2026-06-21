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
        if (Schema::hasTable('mt_barang_detail')) {
            return;
        }

        Schema::create('mt_barang_detail', function (Blueprint $table) {
            $table->increments('id_obat');
            $table->string('kode_brg', 20);
            $table->string('kode_pabrik', 20)->nullable();
            $table->string('kode_generik', 20)->nullable();
            $table->string('nama_brg', 50)->nullable();
            $table->string('kode_kategori', 20)->nullable();
            $table->string('satuan_besar', 20)->nullable();
            $table->string('satuan_kecil', 20)->nullable();
            $table->integer('flag_medis')->nullable();
            $table->integer('jenis_askes')->nullable();
            $table->string('kode_sub_golongan', 50)->nullable();
            $table->string('kode_golongan', 50)->nullable();
            $table->integer('id_pabrik')->nullable();
            $table->string('kode_layanan', 50)->nullable();
            $table->integer('obat_khusus')->nullable();
            $table->integer('kode_jenis')->nullable();
            $table->integer('content')->nullable();
            $table->decimal('harga_satuan', 19, 4)->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->integer('flag')->nullable();

            $table->primary(['id_obat'], 'pk_mt_barang_detail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_barang_detail');
    }
};
