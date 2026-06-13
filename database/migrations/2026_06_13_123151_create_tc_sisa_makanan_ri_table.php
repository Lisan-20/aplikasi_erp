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
        Schema::create('tc_sisa_makanan_ri', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('tgl_hari_ini')->nullable();
            $table->dateTime('tgl_masuk')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->string('nama_pasien', 250)->nullable();
            $table->string('nama_bagian_depo', 250)->nullable();
            $table->decimal('kh', 19, 4)->nullable();
            $table->decimal('phe_1', 19, 4)->nullable();
            $table->decimal('phe_2', 19, 4)->nullable();
            $table->decimal('pna_1', 19, 4)->nullable();
            $table->decimal('pna_2', 19, 4)->nullable();
            $table->decimal('sayur', 19, 4)->nullable();
            $table->decimal('buah', 19, 4)->nullable();
            $table->decimal('snack', 19, 4)->nullable();
            $table->integer('id_user')->nullable();
            $table->dateTime('tgl_entry')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_sisa_makanan_ri');
    }
};
