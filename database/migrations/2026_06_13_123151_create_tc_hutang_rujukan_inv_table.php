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
        Schema::create('tc_hutang_rujukan_inv', function (Blueprint $table) {
            $table->increments('id_tc_hutang_rujukan_inv');
            $table->integer('id_tc_hutang_rujukan_vcr')->nullable();
            $table->string('no_voucher', 50)->nullable();
            $table->decimal('total_harga', 18)->nullable();
            $table->decimal('total_sbl_ppn', 18)->nullable();
            $table->decimal('total_ppn', 18)->nullable();
            $table->decimal('diskon', 18)->nullable();
            $table->decimal('selisih', 18)->nullable();
            $table->integer('id_dd_user')->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('status_ver')->nullable();

            $table->primary(['id_tc_hutang_rujukan_inv'], 'pk_tc_hutang_rujukan_inv');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_hutang_rujukan_inv');
    }
};
