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
        Schema::create('lap_kunjungan_lab_temp', function (Blueprint $table) {
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
            $table->integer('kimia')->nullable();
            $table->integer('hematologi')->nullable();
            $table->integer('serologi')->nullable();
            $table->integer('bakteriologi')->nullable();
            $table->integer('urinalisa')->nullable();
            $table->integer('feaces')->nullable();
            $table->integer('tglnya')->nullable();
            $table->integer('blnnya')->nullable();
            $table->integer('thnnya')->nullable();
            $table->string('kode_bagian', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lap_kunjungan_lab_temp');
    }
};
