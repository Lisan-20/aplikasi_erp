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
        Schema::create('bedah_ok', function (Blueprint $table) {
            $table->string('kode_master_tarif_detail')->nullable();
            $table->float('kode_klas', 53, 0)->nullable();
            $table->float('bill_rs', 53, 0)->nullable();
            $table->float('bill_dr1', 53, 0)->nullable();
            $table->float('bill_dr2', 53, 0)->nullable();
            $table->float('kode_tgl_tarif', 53, 0)->nullable();
            $table->float('kode_tarif', 53, 0)->nullable();
            $table->float('total', 53, 0)->nullable();
            $table->string('obat')->nullable();
            $table->string('alkes')->nullable();
            $table->string('adm')->nullable();
            $table->string('bhp')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('bill_dr3')->nullable();
            $table->string('kamar_tindakan')->nullable();
            $table->string('paramedis')->nullable();
            $table->string('bill_rs_spesialis')->nullable();
            $table->string('bill_dr1_spesialis')->nullable();
            $table->string('bill_dr2_spesialis')->nullable();
            $table->string('pendapatan_rs')->nullable();
            $table->string('pendapatan_rs_spesialis')->nullable();
            $table->string('total_spesialis')->nullable();
            $table->string('bill_rs_rujukan')->nullable();
            $table->string('sewa_alat')->nullable();
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
            $table->float('total_pt', 53, 0)->nullable();
            $table->float('total_ass', 53, 0)->nullable();
            $table->float('total_bpjs', 53, 0)->nullable();
            $table->string('flag_edit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bedah_ok');
    }
};
