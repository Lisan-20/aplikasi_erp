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
        Schema::create('tc_anggaran_biaya', function (Blueprint $table) {
            $table->increments('id_angg_bln');
            $table->string('kode_bagian', 18)->nullable();
            $table->integer('bln')->nullable();
            $table->integer('thn')->nullable();
            $table->string('agg_no', 10)->nullable();
            $table->decimal('minggu1', 18)->nullable();
            $table->decimal('minggu2', 18)->nullable();
            $table->decimal('minggu3', 18)->nullable();
            $table->decimal('minggu4', 18)->nullable();
            $table->string('catatan_pengajuan')->nullable();
            $table->dateTime('tgl_pengajuan')->nullable();
            $table->integer('user_id')->nullable();
            $table->decimal('rev_minggu1', 18)->nullable();
            $table->decimal('rev_minggu2', 18)->nullable();
            $table->decimal('rev_minggu3', 18)->nullable();
            $table->decimal('rev_minggu4', 18)->nullable();
            $table->string('catatan_rev_pengajuan')->nullable();
            $table->dateTime('tgl_rev_pengajuan')->nullable();
            $table->integer('user_id_rev')->nullable();
            $table->decimal('ver_minggu1', 18)->nullable();
            $table->decimal('ver_minggu2', 18)->nullable();
            $table->decimal('ver_minggu3', 18)->nullable();
            $table->decimal('ver_minggu4', 18)->nullable();
            $table->string('catatan_verifikasi')->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('user_id_ver')->nullable();
            $table->decimal('rev_ver_minggu1', 18)->nullable();
            $table->decimal('rev_ver_minggu2', 18)->nullable();
            $table->decimal('rev_ver_minggu3', 18)->nullable();
            $table->decimal('rev_ver_minggu4', 18)->nullable();
            $table->string('catatan_rev_verifikasi')->nullable();
            $table->dateTime('tgl_rev_ver')->nullable();
            $table->integer('user_id_rev_ver')->nullable();
            $table->integer('status')->nullable();
            $table->integer('level_agg')->nullable();
            $table->integer('flag_agg')->nullable();
            $table->decimal('minggu5', 18)->nullable();
            $table->decimal('rev_minggu5', 18)->nullable();
            $table->decimal('ver_minggu5', 18)->nullable();
            $table->decimal('rev_ver_minggu5', 18)->nullable();
            $table->integer('flag_umd')->nullable();
            $table->integer('id_trans_umd')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_anggaran_biaya');
    }
};
