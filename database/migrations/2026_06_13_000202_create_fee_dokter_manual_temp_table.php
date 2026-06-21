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
        if (Schema::hasTable('fee_dokter_manual_temp')) {
            return;
        }

        Schema::create('fee_dokter_manual_temp', function (Blueprint $table) {
            $table->increments('id_fee_dr_manual');
            $table->string('no_kuitansi', 50)->nullable();
            $table->string('seri_kuitansi', 50)->nullable();
            $table->string('no_reg', 50)->nullable();
            $table->string('no_mr', 50)->nullable();
            $table->string('kode_bag', 50)->nullable();
            $table->integer('kode_dr')->nullable();
            $table->decimal('bill_rs', 19, 4)->nullable();
            $table->decimal('bill_dr', 19, 4)->nullable();
            $table->date('tgl_kuitansi')->nullable();
            $table->string('kode_tarif', 50)->nullable();
            $table->string('nama_tarif', 50)->nullable();
            $table->string('keterangan', 150)->nullable();
            $table->dateTime('tgl_billing')->nullable();
            $table->integer('kode_kelompok')->nullable();
            $table->integer('kode_klas')->nullable();
            $table->integer('bill_rs_real')->nullable();
            $table->integer('bill_dr_real')->nullable();
            $table->integer('flag_dr')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('no_induk')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_dokter_manual_temp');
    }
};
