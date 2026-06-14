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
        if (Schema::hasTable('tc_biaya_op')) {
            return;
        }

        Schema::create('tc_biaya_op', function (Blueprint $table) {
            $table->increments('id_tc_biaya_op');
            $table->integer('id_dd_anggaran')->nullable();
            $table->dateTime('tgl_biaya_op')->nullable();
            $table->dateTime('tgl_tagih_biaya_op')->nullable();
            $table->string('bukti_biaya_op', 20)->nullable();
            $table->string('keterangan_biaya_op', 100)->nullable();
            $table->decimal('nilai_debet_biaya_op', 19, 4)->nullable();
            $table->decimal('nilai_kredit_biaya_op', 19, 4)->nullable();
            $table->integer('status_biaya_op')->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->dateTime('status_tgl')->nullable();

            $table->primary(['id_tc_biaya_op'], 'pk_tc_biaya_op');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_biaya_op');
    }
};
