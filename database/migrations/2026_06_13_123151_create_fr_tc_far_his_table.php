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
        Schema::create('fr_tc_far_his', function (Blueprint $table) {
            $table->integer('kd_his');
            $table->integer('kd_tr_resep')->nullable();
            $table->dateTime('tgl_his_retur')->nullable();
            $table->decimal('jumlah_retur_his', 19, 4)->nullable();
            $table->decimal('biaya_retur_his', 19, 4)->nullable();
            $table->string('ket_his', 50)->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('no_retur')->nullable();

            $table->primary(['kd_his'], 'pk_fr_tc_far_his_1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fr_tc_far_his');
    }
};
