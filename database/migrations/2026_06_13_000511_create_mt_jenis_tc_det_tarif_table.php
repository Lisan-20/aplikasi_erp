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
        if (Schema::hasTable('mt_jenis_tc_det_tarif')) {
            return;
        }

        Schema::create('mt_jenis_tc_det_tarif', function (Blueprint $table) {
            $table->increments('id_tc_detail_tarif');
            $table->integer('nomer_tind')->nullable();
            $table->integer('no')->nullable();
            $table->decimal('penggunaan', 18, 0)->nullable();
            $table->decimal('harga', 19, 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_jenis_tc_det_tarif');
    }
};
