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
        Schema::create('mt_barang_det', function (Blueprint $table) {
            $table->increments('id_obat_det');
            $table->string('kode_brg', 20)->nullable();
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
            $table->integer('kode_rotasi')->nullable();
            $table->integer('kode_supplier')->nullable();
            $table->integer('sub_content')->nullable();
            $table->string('satuan_plg_kecil', 20)->nullable();
            $table->decimal('on_rp', 18, 0)->nullable();
            $table->integer('on_persen')->nullable();
            $table->decimal('off_rp', 18, 0)->nullable();
            $table->integer('off_persen')->nullable();
            $table->char('diskon_on', 10)->nullable();
            $table->char('diskon_off', 10)->nullable();
            $table->integer('status_aktif')->nullable();
            $table->integer('flag_prod')->nullable();
            $table->string('kode_brg_ref', 20)->nullable();
            $table->decimal('rf', 19, 4)->nullable();
            $table->decimal('persen_dr', 18)->nullable();
            $table->string('gol_obat', 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_barang_det');
    }
};
