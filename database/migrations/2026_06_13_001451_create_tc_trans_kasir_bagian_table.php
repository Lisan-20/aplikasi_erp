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
        if (Schema::hasTable('tc_trans_kasir_bagian')) {
            return;
        }

        Schema::create('tc_trans_kasir_bagian', function (Blueprint $table) {
            $table->increments('id_tc_trans_kasir_bagian');
            $table->integer('kode_tc_trans_kasir')->nullable();
            $table->string('kode_bagian', 18)->nullable();

            $table->primary(['id_tc_trans_kasir_bagian'], 'pk_tc_trans_kasir_bagian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_trans_kasir_bagian');
    }
};
