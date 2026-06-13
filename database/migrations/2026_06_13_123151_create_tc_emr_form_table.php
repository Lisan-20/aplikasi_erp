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
        Schema::create('tc_emr_form', function (Blueprint $table) {
            $table->increments('id_tc_emr');
            $table->string('no_mr', 10)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->integer('kode_rm')->nullable();
            $table->dateTime('tgl_update')->nullable()->index('ix_tgl_update');
            $table->integer('id_user')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->dateTime('tgl_imp_askep')->nullable();
            $table->integer('id_user_imp')->nullable();
            $table->string('nama_kel_pas', 250)->nullable();
            $table->text('ttd_ri')->nullable();
            $table->dateTime('tgl_ttd')->nullable();
            $table->integer('no_urut')->nullable();
            $table->integer('kode_rm_inp')->nullable();
            $table->dateTime('tgl_verif_dok')->nullable();
            $table->integer('kd_dokter_ver')->nullable();
            $table->text('ket')->nullable();
            $table->integer('flag_ver')->nullable();
            $table->integer('id_terapi')->nullable();
            $table->integer('flag_respon')->nullable();
            $table->dateTime('tgl_jam_respon')->nullable();
            $table->integer('id_user_respon')->nullable();
            $table->string('filename', 250)->nullable();
            $table->string('link_url', 250)->nullable();
            $table->string('document_token', 250)->nullable();
            $table->string('reference_number', 250)->nullable();
            $table->dateTime('update_at')->nullable();
            $table->string('signed_document', 250)->nullable();
            $table->integer('flag_privy')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_emr_form');
    }
};
