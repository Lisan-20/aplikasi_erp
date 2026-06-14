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
        if (Schema::hasTable('bd_tc_trans_flag_dr')) {
            return;
        }

        Schema::create('bd_tc_trans_flag_dr', function (Blueprint $table) {
            $table->increments('id_bd_tc_trans_flag_dr');
            $table->integer('kode_trans_pelayanan')->nullable();
            $table->integer('flag_kui_dr1')->nullable();
            $table->integer('flag_kui_dr2')->nullable();
            $table->integer('flag_kui_dr3')->nullable();
            $table->integer('flag_kui_dr4')->nullable();
            $table->integer('flag_kui_dr5')->nullable();

            $table->primary(['id_bd_tc_trans_flag_dr'], 'pk_bd_tc_trans_flag_dr');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bd_tc_trans_flag_dr');
    }
};
