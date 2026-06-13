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
        Schema::create('mt_dokter_luar', function (Blueprint $table) {
            $table->increments('id_mt_dokter');
            $table->integer('kode_dokter_luar')->nullable();
            $table->string('nama_dokter')->nullable();
            $table->string('alamat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_dokter_luar');
    }
};
