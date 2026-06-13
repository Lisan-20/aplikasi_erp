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
        if (Schema::hasTable('tc_rujukan_luar')) {
            return;
        }

        Schema::create('tc_rujukan_luar', function (Blueprint $table) {
            $table->increments('id_luar');
            $table->integer('no_kunjungan')->nullable();
            $table->string('kesimpulan', 250)->nullable();
            $table->string('nama_file', 250)->nullable();
            $table->string('no_registrasi', 50)->nullable();
            $table->string('kode_dokter', 50)->nullable();
            $table->string('anjuran', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_rujukan_luar');
    }
};
