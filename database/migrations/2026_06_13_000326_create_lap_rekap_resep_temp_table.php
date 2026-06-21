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
        if (Schema::hasTable('lap_rekap_resep_temp')) {
            return;
        }

        Schema::create('lap_rekap_resep_temp', function (Blueprint $table) {
            $table->integer('tgl')->nullable();
            $table->integer('bln')->nullable();
            $table->integer('thn')->nullable();
            $table->integer('opd_umum')->nullable();
            $table->integer('opd_pt')->nullable();
            $table->integer('opd_ass')->nullable();
            $table->integer('opd_bpjsPbi')->nullable();
            $table->integer('opd_bpjsNPbi')->nullable();
            $table->integer('opd_bpjsCob')->nullable();
            $table->integer('opd_bpjsTk')->nullable();
            $table->integer('opd_jamkesda')->nullable();
            $table->integer('ipd_umum')->nullable();
            $table->integer('ipd_pt')->nullable();
            $table->integer('ipd_ass')->nullable();
            $table->integer('ipd_bpjsPbi')->nullable();
            $table->integer('ipd_bpjsNPbi')->nullable();
            $table->integer('ipd_bpjsCob')->nullable();
            $table->integer('ipd_bpjsTk')->nullable();
            $table->integer('ipd_jamkesda')->nullable();
            $table->integer('resep_luar')->nullable();
            $table->integer('resep_bebas')->nullable();
            $table->integer('resep_karyawan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lap_rekap_resep_temp');
    }
};
