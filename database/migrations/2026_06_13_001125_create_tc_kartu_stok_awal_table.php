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
        if (Schema::hasTable('tc_kartu_stok_awal')) {
            return;
        }

        Schema::create('tc_kartu_stok_awal', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('tgl_input')->nullable();
            $table->string('kode_brg', 20)->nullable();
            $table->decimal('stok_awal', 18)->nullable();
            $table->string('kode_bagian', 20)->nullable();
            $table->integer('bln')->nullable();
            $table->integer('thn')->nullable();
            $table->integer('id_kartu')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_kartu_stok_awal');
    }
};
