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
        if (Schema::hasTable('fr_gg_return_brg')) {
            return;
        }

        Schema::create('fr_gg_return_brg', function (Blueprint $table) {
            $table->integer('id_return');
            $table->dateTime('tgl_input')->nullable();
            $table->string('kode_brg', 50)->nullable();
            $table->string('kode_supplier', 50)->nullable();
            $table->string('no_po', 50)->nullable();
            $table->string('no_lpb', 50)->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('petugas', 50)->nullable();
            $table->string('ket', 100)->nullable();
            $table->string('kode_return', 50)->nullable();
            $table->tinyInteger('flag_jurnal')->nullable();

            $table->primary(['id_return'], 'id_return');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fr_gg_return_brg');
    }
};
