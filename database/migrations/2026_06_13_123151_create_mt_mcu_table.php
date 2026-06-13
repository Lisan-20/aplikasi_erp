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
        if (Schema::hasTable('mt_mcu')) {
            return;
        }

        Schema::create('mt_mcu', function (Blueprint $table) {
            $table->integer('id_mt_mcu');
            $table->integer('kode_referensi')->nullable();
            $table->integer('kode_mcu')->nullable();
            $table->string('item_pemeriksaan')->nullable();
            $table->integer('tingkat')->nullable();
            $table->integer('induk')->nullable();

            $table->primary(['id_mt_mcu'], 'pk_mt_mcu_1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_mcu');
    }
};
