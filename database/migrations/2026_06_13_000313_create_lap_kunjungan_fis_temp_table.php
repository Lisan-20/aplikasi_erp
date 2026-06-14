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
        if (Schema::hasTable('lap_kunjungan_fis_temp')) {
            return;
        }

        Schema::create('lap_kunjungan_fis_temp', function (Blueprint $table) {
            $table->integer('opd_luar')->nullable();
            $table->integer('opd_dalam')->nullable();
            $table->integer('ipd')->nullable();
            $table->integer('umum')->nullable();
            $table->integer('BpjsPbi')->nullable();
            $table->integer('BpjsNonPbi')->nullable();
            $table->integer('BpjsKtngkrja')->nullable();
            $table->integer('jamkesda')->nullable();
            $table->integer('pt')->nullable();
            $table->integer('asuransi')->nullable();
            $table->integer('chest')->nullable();
            $table->integer('exer_brt')->nullable();
            $table->integer('exer_sdg')->nullable();
            $table->integer('exer_rgn')->nullable();
            $table->integer('infrared1')->nullable();
            $table->integer('infrared2')->nullable();
            $table->integer('inhalasi')->nullable();
            $table->integer('mass_man')->nullable();
            $table->integer('tens2')->nullable();
            $table->integer('tens1')->nullable();
            $table->integer('ultrasound')->nullable();
            $table->integer('tglnya')->nullable();
            $table->integer('blnnya')->nullable();
            $table->integer('thnnya')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lap_kunjungan_fis_temp');
    }
};
