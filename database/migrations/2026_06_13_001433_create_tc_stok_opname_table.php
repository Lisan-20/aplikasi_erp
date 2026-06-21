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
        if (Schema::hasTable('tc_stok_opname')) {
            return;
        }

        Schema::create('tc_stok_opname', function (Blueprint $table) {
            $table->increments('id_tc_stok_opname');
            $table->dateTime('tgl_stok_opname')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->string('kode_brg', 50)->nullable();
            $table->decimal('stok_sebelum', 18)->nullable();
            $table->integer('stok_sekarang_old')->nullable();
            $table->integer('id_dd_user')->nullable();
            $table->decimal('stok_sekarang', 18)->nullable();
            $table->decimal('harga_beli', 18)->nullable();

            $table->primary(['id_tc_stok_opname'], 'pk_tc_stok_opname_2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_stok_opname');
    }
};
