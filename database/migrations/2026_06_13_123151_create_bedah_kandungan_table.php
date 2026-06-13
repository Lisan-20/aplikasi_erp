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
        Schema::create('bedah_kandungan', function (Blueprint $table) {
            $table->increments('kode');
            $table->integer('kode_klas');
            $table->integer('bill_rs');
            $table->integer('bill_dr1');
            $table->integer('bill_dr2');
            $table->integer('kode_tgl_tarif');
            $table->integer('kode_tarif');
            $table->integer('total');
            $table->integer('obat')->nullable();
            $table->integer('alkes')->nullable();
            $table->integer('alat_rs')->nullable();
            $table->integer('adm')->nullable();
            $table->integer('bhp')->nullable();
            $table->string('keterangan', 50)->nullable();
            $table->integer('pendapatan_rs')->nullable();
            $table->integer('bill_dr3')->nullable();
            $table->integer('kamar_tindakan')->nullable();
            $table->integer('paramedis')->nullable();
            $table->string('detail', 50)->nullable();
            $table->integer('no_urut')->nullable();
            $table->decimal('bill_dr1_bpjs', 19, 4)->nullable();
            $table->decimal('bill_dr2_bpjs', 19, 4)->nullable();
            $table->decimal('bill_rs_bpjs', 19, 4)->nullable();
            $table->decimal('total_bpjs', 19, 4)->nullable();
            $table->decimal('bill_rs_nayaka', 19, 4)->nullable();
            $table->decimal('bill_dr1_nayaka', 19, 4)->nullable();
            $table->decimal('bill_dr2_nayaka', 19, 4)->nullable();
            $table->decimal('total_nayaka', 19, 4)->nullable();
            $table->decimal('bill_rs_hardlent', 19, 4)->nullable();
            $table->decimal('bill_dr1_hardlent', 19, 4)->nullable();
            $table->decimal('bill_dr2_hardlent', 19, 4)->nullable();
            $table->decimal('total_hardlent', 19, 4)->nullable();
            $table->decimal('bill_rs_inhealth', 19, 4)->nullable();
            $table->decimal('bill_dr1_inhealth', 19, 4)->nullable();
            $table->decimal('bill_dr2_inhealth', 19, 4)->nullable();
            $table->decimal('total_inhealth1', 19, 4)->nullable();
            $table->decimal('bill_rs_cahaya', 19, 4)->nullable();
            $table->decimal('bill_dr1_cahaya', 19, 4)->nullable();
            $table->decimal('bill_dr2_cahaya', 19, 4)->nullable();
            $table->decimal('total_cahaya', 19, 4)->nullable();
            $table->integer('kode_tarif_lev4')->nullable();
            $table->decimal('bill_rs_kapitasi', 19, 4)->nullable();
            $table->decimal('bill_dr1_kapitasi', 19, 4)->nullable();
            $table->decimal('bill_dr2_kapitasi', 19, 4)->nullable();
            $table->decimal('total_kapitasi', 19, 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bedah_kandungan');
    }
};
