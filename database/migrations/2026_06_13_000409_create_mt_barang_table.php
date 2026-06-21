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
        if (Schema::hasTable('mt_barang')) {
            return;
        }

        Schema::create('mt_barang', function (Blueprint $table) {
            $table->bigIncrements('id_obat');
            $table->string('kode_brg', 20);
            $table->string('kode_pabrik', 20)->nullable();
            $table->string('kode_generik', 20)->nullable();
            $table->text('nama_brg')->nullable();
            $table->string('kode_kategori', 20)->nullable();
            $table->string('satuan_besar', 250)->nullable();
            $table->string('satuan_kecil', 250)->nullable();
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
            $table->string('satuan_plg_kecil', 50)->nullable();
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
            $table->decimal('tarif_inhealth', 18)->nullable();
            $table->integer('flag_dpho')->nullable();
            $table->text('barcode')->nullable();
            $table->integer('user_edit')->nullable();
            $table->dateTime('tgl_edit')->nullable();
            $table->string('kode_brg_nonmedis', 50)->nullable();
            $table->integer('flag_promo')->nullable();
            $table->string('satuan_kekuatan', 50)->nullable();
            $table->string('kekuatan', 50)->nullable();
            $table->string('kfa_poa', 50)->nullable();
            $table->integer('id_gol_obat')->nullable();

            $table->primary(['kode_brg'], 'pk_mt_barang_baru');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_barang');
    }
};
