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
        Schema::create('mt_master_tarif_detail_rev', function (Blueprint $table) {
            $table->increments('kode_master_tarif_detail');
            $table->integer('kode_klas');
            $table->integer('bill_rs')->default(0);
            $table->integer('bill_dr1')->default(0);
            $table->integer('bill_dr2')->default(0);
            $table->integer('kode_tgl_tarif')->default(1);
            $table->integer('kode_tarif');
            $table->integer('total')->default(0);
            $table->integer('obat')->nullable();
            $table->integer('alkes')->nullable();
            $table->integer('adm')->nullable();
            $table->integer('bhp')->nullable();
            $table->string('keterangan', 50)->nullable();
            $table->integer('bill_dr3')->nullable();
            $table->integer('kamar_tindakan')->nullable();
            $table->integer('paramedis')->nullable();
            $table->integer('bill_rs_spesialis')->nullable();
            $table->integer('bill_dr1_spesialis')->nullable();
            $table->integer('bill_dr2_spesialis')->nullable();
            $table->integer('pendapatan_rs')->nullable();
            $table->integer('pendapatan_rs_spesialis')->nullable();
            $table->integer('total_spesialis')->nullable();
            $table->integer('bill_rs_rujukan')->nullable();
            $table->integer('sewa_alat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_master_tarif_detail_rev');
    }
};
