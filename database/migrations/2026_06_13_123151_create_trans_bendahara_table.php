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
        if (Schema::hasTable('trans_bendahara')) {
            return;
        }

        Schema::create('trans_bendahara', function (Blueprint $table) {
            $table->increments('id_trans_bendahara');
            $table->integer('kd_trans_bendahara');
            $table->integer('kd_group_trans')->nullable();
            $table->integer('acc_no')->nullable();
            $table->string('kas_bank', 1)->nullable();
            $table->string('masuk_keluar', 1)->nullable();
            $table->string('uraian_trans')->nullable();
            $table->integer('int')->nullable();

            $table->primary(['id_trans_bendahara'], 'pk_trans_bendahara');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trans_bendahara');
    }
};
