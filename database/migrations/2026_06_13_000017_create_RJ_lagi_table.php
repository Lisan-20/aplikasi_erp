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
        if (Schema::hasTable('RJ_lagi')) {
            return;
        }

        Schema::create('RJ_lagi', function (Blueprint $table) {
            $table->string('kode_master_tarif_detail')->nullable();
            $table->float(' kode_klas', 53, 0)->nullable();
            $table->float('bill_rs', 53, 0)->nullable();
            $table->float('bill_dr1', 53, 0)->nullable();
            $table->float('bill_dr2', 53, 0)->nullable();
            $table->float('kode_tgl_tarif', 53, 0)->nullable();
            $table->float('kode_tarif', 53, 0)->nullable();
            $table->float('total', 53, 0)->nullable();
            $table->float('obat', 53, 0)->nullable();
            $table->float('alkes', 53, 0)->nullable();
            $table->float('adm', 53, 0)->nullable();
            $table->float('bhp', 53, 0)->nullable();
            $table->float('keterangan', 53, 0)->nullable();
            $table->float('bill_dr3', 53, 0)->nullable();
            $table->float('kamar_tindakan', 53, 0)->nullable();
            $table->float('paramedis', 53, 0)->nullable();
            $table->float('bill_rs_spesialis', 53, 0)->nullable();
            $table->float('bill_dr1_spesialis', 53, 0)->nullable();
            $table->float('bill_dr2_spesialis', 53, 0)->nullable();
            $table->float('pendapatan_rs', 53, 0)->nullable();
            $table->float('pendapatan_rs_spesialis', 53, 0)->nullable();
            $table->float('total_spesialis', 53, 0)->nullable();
            $table->float('bill_rs_rujukan', 53, 0)->nullable();
            $table->float('sewa_alat', 53, 0)->nullable();
            $table->float('bill_rs_pt', 53, 0)->nullable();
            $table->float('bill_dr1_pt', 53, 0)->nullable();
            $table->float('bill_dr2_pt', 53, 0)->nullable();
            $table->float('bill_rs_ass', 53, 0)->nullable();
            $table->float('bill_dr1_ass', 53, 0)->nullable();
            $table->float('bill_dr2_ass', 53, 0)->nullable();
            $table->float('bill_rs_bpjs', 53, 0)->nullable();
            $table->float('bill_dr1_bpjs', 53, 0)->nullable();
            $table->float('bill_dr2_bpjs', 53, 0)->nullable();
            $table->float('bill_rs_inhealth', 53, 0)->nullable();
            $table->float('bill_dr1_inhealth', 53, 0)->nullable();
            $table->float('bill_dr2_inhealth', 53, 0)->nullable();
            $table->float('total_inhealth', 53, 0)->nullable();
            $table->float(' total_pt', 53, 0)->nullable();
            $table->float('total_ass', 53, 0)->nullable();
            $table->float('total_bpjs', 53, 0)->nullable();
            $table->float('flag_edit', 53, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('RJ_lagi');
    }
};
