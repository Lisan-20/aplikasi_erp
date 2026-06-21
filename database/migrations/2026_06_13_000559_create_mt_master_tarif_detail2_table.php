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
        if (Schema::hasTable('mt_master_tarif_detail2')) {
            return;
        }

        Schema::create('mt_master_tarif_detail2', function (Blueprint $table) {
            $table->increments('kode_master_tarif_detail');
            $table->integer('kode_klas');
            $table->integer('bill_rs');
            $table->integer('bill_dr1');
            $table->integer('bill_dr2');
            $table->integer('kode_tgl_tarif');
            $table->integer('kode_tarif');
            $table->integer('total');
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
            $table->integer('bill_rs_pt')->nullable();
            $table->integer('bill_dr1_pt')->nullable();
            $table->integer('bill_dr2_pt')->nullable();
            $table->integer('bill_rs_ass')->nullable();
            $table->integer('bill_dr1_ass')->nullable();
            $table->integer('bill_dr2_ass')->nullable();
            $table->integer('bill_rs_bpjs')->nullable();
            $table->integer('bill_dr1_bpjs')->nullable();
            $table->integer('bill_dr2_bpjs')->nullable();
            $table->integer('bill_rs_inhealth')->nullable();
            $table->integer('bill_dr1_inhealth')->nullable();
            $table->integer('bill_dr2_inhealth')->nullable();
            $table->integer('total_inhealth')->nullable();
            $table->integer('total_pt')->nullable();
            $table->integer('total_ass')->nullable();
            $table->integer('total_bpjs')->nullable();
            $table->integer('flag_edit')->nullable();
            $table->integer('adm_baru')->nullable();

            $table->primary(['kode_master_tarif_detail'], 'pk_mt_master_tarif_detail_ok');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_master_tarif_detail2');
    }
};
