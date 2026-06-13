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
        Schema::create('bedah_I', function (Blueprint $table) {
            $table->float('kode', 53, 0)->nullable();
            $table->float('kode_klas', 53, 0)->nullable();
            $table->float('bill_rs', 53, 0)->nullable();
            $table->float('bill_dr1', 53, 0)->nullable();
            $table->float('bill_dr2', 53, 0)->nullable();
            $table->float('kode_tgl_tarif', 53, 0)->nullable();
            $table->float('kode_tarif', 53, 0)->nullable();
            $table->float('total', 53, 0)->nullable();
            $table->string('obat')->nullable();
            $table->string('alkes')->nullable();
            $table->string('alat_rs')->nullable();
            $table->string('adm')->nullable();
            $table->string('bhp')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('pendapatan_rs')->nullable();
            $table->string('bill_dr3')->nullable();
            $table->string('kamar_tindakan')->nullable();
            $table->string('paramedis')->nullable();
            $table->string('detail')->nullable();
            $table->float('no_urut', 53, 0)->nullable();
            $table->float('bill_dr1_bpjs', 53, 0)->nullable();
            $table->float('bill_dr2_bpjs', 53, 0)->nullable();
            $table->float('bill_rs_bpjs', 53, 0)->nullable();
            $table->float('total_bpjs', 53, 0)->nullable();
            $table->float('bill_rs_inhealth', 53, 0)->nullable();
            $table->float('bill_dr1_inhealth', 53, 0)->nullable();
            $table->float('bill_dr2_inhealth', 53, 0)->nullable();
            $table->float('total_inhealth1', 53, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bedah_I');
    }
};
