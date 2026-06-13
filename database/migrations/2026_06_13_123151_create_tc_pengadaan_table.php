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
        Schema::create('tc_pengadaan', function (Blueprint $table) {
            $table->string('no_po', 18);
            $table->dateTime('tgl_po')->nullable();
            $table->integer('discount_harga')->nullable();
            $table->integer('discount_lain')->nullable();
            $table->integer('ppn')->nullable();
            $table->integer('total_sbl_ppn')->nullable();
            $table->integer('total_stl_ppn')->nullable();
            $table->string('term_of_pay', 20)->nullable();
            $table->string('kondisi', 20)->nullable();
            $table->string('kirim_via', 20)->nullable();
            $table->string('di_kirim_ke', 20)->nullable();
            $table->string('petugas', 20)->nullable();
            $table->integer('ongkos_angkut')->nullable();
            $table->integer('status_kirim')->nullable();
            $table->string('barang_untuk', 20)->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('jenis_po')->nullable();
            $table->string('alamat_spp', 20)->nullable();
            $table->string('krs', 20)->nullable();
            $table->string('farmasi', 20)->nullable();
            $table->string('sipa', 20)->nullable();
            $table->dateTime('tgl_kirim')->nullable();
            $table->integer('nomor_permohonan')->nullable();
            $table->string('kode_pembuat', 20)->nullable();

            $table->primary(['no_po'], 'pk__tc_pengadaan__58c7d9d3');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_pengadaan');
    }
};
