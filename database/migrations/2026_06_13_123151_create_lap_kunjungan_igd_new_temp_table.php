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
        Schema::create('lap_kunjungan_igd_new_temp', function (Blueprint $table) {
            $table->integer('tglnya')->nullable();
            $table->integer('blnnya')->nullable();
            $table->integer('thnnya')->nullable();
            $table->integer('ank_laki')->nullable();
            $table->integer('ank_prmp')->nullable();
            $table->integer('dws_laki')->nullable();
            $table->integer('dws_prmp')->nullable();
            $table->integer('lama')->nullable();
            $table->integer('baru')->nullable();
            $table->integer('umum')->nullable();
            $table->integer('BpjsPbi')->nullable();
            $table->integer('BpjsCob')->nullable();
            $table->integer('BpjsNonPbi')->nullable();
            $table->integer('BpjsKtngkrja')->nullable();
            $table->integer('jamkesda')->nullable();
            $table->integer('pt')->nullable();
            $table->integer('asuransi')->nullable();
            $table->integer('tri_hijau')->nullable();
            $table->integer('tri_kuning')->nullable();
            $table->integer('tri_merah')->nullable();
            $table->integer('tri_hitam')->nullable();
            $table->integer('rj_celaka')->nullable();
            $table->integer('rj_Ncelaka')->nullable();
            $table->integer('ri_celaka')->nullable();
            $table->integer('ri_Ncelaka')->nullable();
            $table->integer('ref_celaka')->nullable();
            $table->integer('ref_Ncelaka')->nullable();
            $table->integer('doe_celaka')->nullable();
            $table->integer('doe_Ncelaka')->nullable();
            $table->integer('doa_celaka')->nullable();
            $table->integer('doa_Ncelaka')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lap_kunjungan_igd_new_temp');
    }
};
