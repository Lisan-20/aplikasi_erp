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
        if (Schema::hasTable('tc_bpako_hemodialisa')) {
            return;
        }

        Schema::create('tc_bpako_hemodialisa', function (Blueprint $table) {
            $table->integer('id_tc_bpako_hemo');
            $table->bigInteger('no_kunjungan')->nullable();
            $table->bigInteger('no_registrasi')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->string('kode_brg', 20);
            $table->string('nama_brg', 50)->nullable();
            $table->decimal('jumlah', 19, 4)->nullable();
            $table->integer('id_dd_user')->nullable();
            $table->bigInteger('kode_trans_pelayanan')->nullable();
            $table->bigInteger('kode_penunjang')->nullable();
            $table->integer('kode_tarif')->nullable();
            $table->integer('flag_amprah')->nullable();
            $table->integer('id_tc_permintaan_inst')->nullable();

            $table->primary(['id_tc_bpako_hemo'], 'pk_tc_bpako_hemodialisa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_bpako_hemodialisa');
    }
};
