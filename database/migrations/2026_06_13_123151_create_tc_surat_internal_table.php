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
        Schema::create('tc_surat_internal', function (Blueprint $table) {
            $table->increments('id_surat');
            $table->string('judul')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('nama_file', 250)->nullable();
            $table->string('asal_surat', 250)->nullable();
            $table->string('tujuan_surat', 250)->nullable();
            $table->dateTime('tgl_kirim')->nullable();
            $table->integer('id_dd_user')->nullable();
            $table->integer('jml_di_download')->nullable();
            $table->text('isi_surat')->nullable();
            $table->string('bagian_tujuan', 250)->nullable();
            $table->integer('ver_dir')->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->string('no_surat', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_surat_internal');
    }
};
