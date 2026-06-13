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
        Schema::create('tc_pendaftaran_masal', function (Blueprint $table) {
            $table->integer('id_masal');
            $table->string('penyelenggara', 50)->nullable();
            $table->string('alamat', 50)->nullable();
            $table->integer('no_telp')->nullable();
            $table->string('con_person', 50)->nullable();
            $table->dateTime('tgl_transaksi')->nullable();
            $table->integer('status')->nullable();
            $table->integer('jumlah')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->integer('flag_pembayaran')->nullable();
            $table->integer('flag_adm')->nullable();
            $table->integer('diskon')->nullable();
            $table->string('note_disk', 300)->nullable();
            $table->integer('inp_id')->nullable();
            $table->integer('kode_tarif')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_pendaftaran_masal');
    }
};
