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
        if (Schema::hasTable('tc_kartu_piutang')) {
            return;
        }

        Schema::create('tc_kartu_piutang', function (Blueprint $table) {
            $table->increments('id_tc_kartu_piutang');
            $table->dateTime('tgl_kartu')->nullable();
            $table->string('no_bukti', 50)->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->string('no_mr', 13)->nullable();
            $table->string('keterangan')->nullable();
            $table->decimal('saldo_awal', 19, 4)->nullable();
            $table->decimal('debet', 19, 4)->nullable();
            $table->decimal('kredit', 19, 4)->nullable();
            $table->decimal('saldo_akhir', 19, 4)->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('input_id')->nullable();
            $table->integer('kode_bank_cc')->nullable();
            $table->integer('kode_bank_dc')->nullable();
            $table->integer('kode_askes')->nullable();
            $table->integer('kode_kelompok')->nullable();

            $table->primary(['id_tc_kartu_piutang'], 'pk_tc_kartu_piutang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_kartu_piutang');
    }
};
