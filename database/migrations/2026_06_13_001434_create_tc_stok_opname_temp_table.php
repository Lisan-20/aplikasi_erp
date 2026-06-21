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
        if (Schema::hasTable('tc_stok_opname_temp')) {
            return;
        }

        Schema::create('tc_stok_opname_temp', function (Blueprint $table) {
            $table->string('kode_brg', 100)->nullable();
            $table->string('nama_brg', 100)->nullable();
            $table->string('stok_sebelum', 100)->nullable();
            $table->dateTime('stok_fisik')->nullable();
            $table->string('satuan', 250)->nullable();
            $table->string('kode_bagian', 100)->nullable();
            $table->dateTime('tgl_stok_opname')->nullable();
            $table->integer('id_dd_user')->nullable();
            $table->integer('flag')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_stok_opname_temp');
    }
};
