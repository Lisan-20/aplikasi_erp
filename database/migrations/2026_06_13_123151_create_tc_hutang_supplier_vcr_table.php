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
        if (Schema::hasTable('tc_hutang_supplier_vcr')) {
            return;
        }

        Schema::create('tc_hutang_supplier_vcr', function (Blueprint $table) {
            $table->increments('id_tc_hutang_supplier_vcr');
            $table->integer('kodesupplier')->nullable();
            $table->string('no_voucher', 50)->nullable();
            $table->string('no_faktur', 50)->nullable();
            $table->dateTime('tgl_invoice')->nullable();
            $table->dateTime('tgl_jt')->nullable();
            $table->integer('id_dd_user')->nullable();
            $table->string('no_faktur_pajak', 50)->nullable();
            $table->dateTime('tgl_faktur_pajak')->nullable();
            $table->integer('id_bd_tc_trans')->nullable();

            $table->primary(['id_tc_hutang_supplier_vcr'], 'pk_tc_hutang_supplier_vcr');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_hutang_supplier_vcr');
    }
};
