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
        if (Schema::hasTable('tc_lap_posisi_piutang')) {
            return;
        }

        Schema::create('tc_lap_posisi_piutang', function (Blueprint $table) {
            $table->increments('id_lap_piut');
            $table->integer('kode_perusahaan')->nullable();
            $table->integer('acc_no')->nullable();
            $table->integer('bln')->nullable();
            $table->integer('thn')->nullable();
            $table->string('tx_tipe', 1)->nullable();
            $table->decimal('tx_nominal', 18)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_lap_posisi_piutang');
    }
};
