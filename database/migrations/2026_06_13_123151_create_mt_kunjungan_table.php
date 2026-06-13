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
        Schema::create('mt_kunjungan', function (Blueprint $table) {
            $table->integer('id_mt_kunjungan')->nullable();
            $table->integer('no_kunjungan');
            $table->string('no_mr', 8)->nullable();
            $table->dateTime('tgl_masuk')->nullable();
            $table->dateTime('tgl_keluar')->nullable();
            $table->string('kode_bagian_masuk', 18)->nullable();
            $table->string('kode_bagian_keluar', 18)->nullable();
            $table->integer('status')->nullable();

            $table->primary(['no_kunjungan'], 'pk_mt_kunjungan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_kunjungan');
    }
};
