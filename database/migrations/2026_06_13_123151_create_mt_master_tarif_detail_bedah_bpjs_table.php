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
        if (Schema::hasTable('mt_master_tarif_detail_bedah_bpjs')) {
            return;
        }

        Schema::create('mt_master_tarif_detail_bedah_bpjs', function (Blueprint $table) {
            $table->increments('kode');
            $table->integer('kode_klas');
            $table->integer('bill_rs')->default(0);
            $table->integer('bill_dr1')->default(0);
            $table->integer('bill_dr2')->default(0);
            $table->integer('kode_tgl_tarif')->default(1);
            $table->integer('kode_tarif');
            $table->integer('total')->default(0);
            $table->integer('bhp')->nullable();
            $table->string('keterangan', 50)->nullable();
            $table->integer('pendapatan_rs')->nullable();
            $table->integer('bill_dr3')->nullable();
            $table->string('detail', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_master_tarif_detail_bedah_bpjs');
    }
};
