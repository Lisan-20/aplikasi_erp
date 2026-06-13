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
        Schema::create('tc_oksigen', function (Blueprint $table) {
            $table->increments('id_tc_oksigen');
            $table->bigInteger('kode_trans_pelayanan')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->string('nama_pasien')->nullable();
            $table->dateTime('tgl_transaksi')->nullable();
            $table->string('nama_tindakan')->nullable();
            $table->integer('kode_kelompok')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->string('kode_bagian', 10)->nullable();
            $table->string('kode_bagian_asal', 10)->nullable();
            $table->decimal('jam', 19, 4)->nullable();
            $table->decimal('liter', 19, 4)->nullable();
            $table->decimal('bhp', 19, 4)->nullable();
            $table->decimal('harga_jual', 19, 4)->nullable();
            $table->decimal('harga_trans', 19, 4)->nullable();
            $table->integer('no_induk')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_oksigen');
    }
};
