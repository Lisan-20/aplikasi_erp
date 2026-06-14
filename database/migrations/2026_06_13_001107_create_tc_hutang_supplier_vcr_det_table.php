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
        if (Schema::hasTable('tc_hutang_supplier_vcr_det')) {
            return;
        }

        Schema::create('tc_hutang_supplier_vcr_det', function (Blueprint $table) {
            $table->increments('id_tc_hutang_supplier_vcr_det');
            $table->integer('id_tc_hutang_supplier_vcr')->nullable();
            $table->string('kode_penerimaan', 50)->nullable();
            $table->decimal('jumlah', 19, 4)->nullable();
            $table->string('kode_barang', 50)->nullable();

            $table->primary(['id_tc_hutang_supplier_vcr_det'], 'pk_tc_hutang_supplier_vcr_det');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_hutang_supplier_vcr_det');
    }
};
