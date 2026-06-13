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
        Schema::create('tc_distribusi_makanan_det', function (Blueprint $table) {
            $table->increments('id_dis_det');
            $table->integer('id_dis')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->string('no_registrasi', 20)->nullable();
            $table->integer('kode_klas')->nullable();
            $table->integer('kode_kelompok')->nullable();
            $table->string('kode_bagian', 20)->nullable();
            $table->decimal('harga_satuan', 19, 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_distribusi_makanan_det');
    }
};
