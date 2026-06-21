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
        if (Schema::hasTable('bd_dc_trans_bendahara')) {
            return;
        }

        Schema::create('bd_dc_trans_bendahara', function (Blueprint $table) {
            $table->integer('id_bd_dc_trans_bendahara');
            $table->integer('kd_trans_bendahara');
            $table->integer('kd_group_trans')->nullable();
            $table->string('kas_bank', 1)->nullable();
            $table->string('masuk_keluar', 1)->nullable();
            $table->string('uraian_trans')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bd_dc_trans_bendahara');
    }
};
