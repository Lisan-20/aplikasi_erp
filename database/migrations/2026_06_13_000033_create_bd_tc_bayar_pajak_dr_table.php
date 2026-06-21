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
        if (Schema::hasTable('bd_tc_bayar_pajak_dr')) {
            return;
        }

        Schema::create('bd_tc_bayar_pajak_dr', function (Blueprint $table) {
            $table->increments('id_bd_tc_bayar_pajak_dr');
            $table->dateTime('tgl_pembayaran')->nullable();
            $table->string('no_faktur', 50)->nullable();
            $table->decimal('nominal', 19, 4)->nullable();
            $table->integer('id_input')->nullable();
            $table->dateTime('tgl_input')->nullable();

            $table->primary(['id_bd_tc_bayar_pajak_dr'], 'pk_bd_tc_bayar_pajak_dr');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bd_tc_bayar_pajak_dr');
    }
};
