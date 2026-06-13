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
        Schema::create('mt_rs_cabang', function (Blueprint $table) {
            $table->integer('id_mt_rs_cabang');
            $table->integer('kode_rs')->nullable();
            $table->string('nama_rs')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->integer('kodesupplier')->nullable();
            $table->string('kode_bagian', 20)->nullable();
            $table->integer('ko_wil')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_rs_cabang');
    }
};
