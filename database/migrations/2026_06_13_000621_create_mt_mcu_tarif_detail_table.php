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
        if (Schema::hasTable('mt_mcu_tarif_detail')) {
            return;
        }

        Schema::create('mt_mcu_tarif_detail', function (Blueprint $table) {
            $table->integer('id_mt_mcu_detail');
            $table->integer('kode_mt_mcu')->nullable();
            $table->integer('kode_tarif')->nullable();
            $table->integer('kode_referensi')->nullable();
            $table->string('kode_bagian', 18)->nullable();
            $table->integer('bill_rs')->nullable();
            $table->integer('bill_dr')->nullable();
            $table->integer('total')->nullable();
            $table->integer('kode_tgl_tarif')->nullable();

            $table->primary(['id_mt_mcu_detail'], 'pk_mt_mcu_tarif_detail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_mcu_tarif_detail');
    }
};
