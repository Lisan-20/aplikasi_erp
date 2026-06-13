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
        Schema::create('resum_obat_lengkap_temp', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_tindakan', 250)->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->integer('kode_trans_far')->nullable();
            $table->string('kode_barang', 20)->nullable();
            $table->string('jml_pakai', 50)->nullable();
            $table->string('jml_takar', 50)->nullable();
            $table->string('takaran', 50)->nullable();
            $table->string('penggunaan', 250)->nullable();
            $table->dateTime('tgl_transaksi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resum_obat_lengkap_temp');
    }
};
