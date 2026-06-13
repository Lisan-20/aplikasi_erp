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
        Schema::create('tc_dp_po_supp', function (Blueprint $table) {
            $table->increments('id_tc_dp_po');
            $table->integer('id_tc_po');
            $table->dateTime('tgl_bayar')->nullable();
            $table->string('no_po', 50)->nullable();
            $table->decimal('nominal', 19, 4)->nullable();
            $table->integer('id_bd_tc_trans')->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('id_tc_hutang_supplier_vcr')->nullable();
            $table->integer('id_tc_hutang_supplier_inv')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_dp_po_supp');
    }
};
