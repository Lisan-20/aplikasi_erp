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
        Schema::create('tc_permintaan_instalasi_detail', function (Blueprint $table) {
            $table->string('no_urut_permintaan', 18);
            $table->string('kode_brg', 20)->nullable();
            $table->integer('nomor_permintaan')->nullable();
            $table->integer('jum_permintaan')->nullable();
            $table->string('satuan', 20)->nullable();
            $table->dateTime('tgl_acc')->nullable();
            $table->integer('acc_gudang')->nullable();
            $table->integer('penerimaan_brg')->nullable();
            $table->integer('kekurangan')->nullable();

            $table->primary(['no_urut_permintaan'], 'pk__tc_permintaan_in__6068fb9b');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_permintaan_instalasi_detail');
    }
};
