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
        Schema::create('th_permintaan_instalasi', function (Blueprint $table) {
            $table->string('no_history', 18);
            $table->integer('no_urut_permintaan')->nullable();
            $table->dateTime('tgl_acc')->nullable();
            $table->integer('acc_gudang')->nullable();
            $table->integer('penerimaan_brg')->nullable();
            $table->string('yg_terima', 20)->nullable();
            $table->string('yg_serah', 20)->nullable();
            $table->dateTime('tgl_serah')->nullable();

            $table->primary(['no_history'], 'pk__tch_permintaan_i__680a1d63');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_permintaan_instalasi');
    }
};
