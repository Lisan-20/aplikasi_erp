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
        if (Schema::hasTable('lap_kunjungan_far_temp')) {
            return;
        }

        Schema::create('lap_kunjungan_far_temp', function (Blueprint $table) {
            $table->integer('tglnya')->nullable();
            $table->integer('blnnya')->nullable();
            $table->integer('thnnya')->nullable();
            $table->integer('ipd_umum')->nullable();
            $table->integer('ipd_BpjsPbi')->nullable();
            $table->integer('ipd_BpjsCob')->nullable();
            $table->integer('ipd_BpjsNonPbi')->nullable();
            $table->integer('ipd_BpjsKtngkrja')->nullable();
            $table->integer('ipd_jamkesda')->nullable();
            $table->integer('ipd_pt')->nullable();
            $table->integer('ipd_asuransi')->nullable();
            $table->integer('opd_umum')->nullable();
            $table->integer('opd_BpjsPbi')->nullable();
            $table->integer('opd_BpjsCob')->nullable();
            $table->integer('opd_BpjsNonPbi')->nullable();
            $table->integer('opd_BpjsKtngkrja')->nullable();
            $table->integer('opd_jamkesda')->nullable();
            $table->integer('opd_pt')->nullable();
            $table->integer('opd_asuransi')->nullable();
            $table->integer('resep_luar')->nullable();
            $table->integer('obat_bebas')->nullable();
            $table->integer('obat_karyawan')->nullable();
            $table->integer('racikan')->nullable();
            $table->integer('non_racikan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lap_kunjungan_far_temp');
    }
};
