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
        Schema::create('tc_retur_unit_det', function (Blueprint $table) {
            $table->increments('id_tc_retur_unit_det');
            $table->integer('kode_retur')->nullable();
            $table->string('kode_brg', 20)->nullable();
            $table->integer('jumlah')->nullable();
            $table->text('alasan')->nullable();
            $table->integer('jml_sebelum')->nullable();

            $table->primary(['id_tc_retur_unit_det'], 'pk_tc_retur_unit_det');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_retur_unit_det');
    }
};
