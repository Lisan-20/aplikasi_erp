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
        Schema::create('bd_dc_group_trans_bendahara', function (Blueprint $table) {
            $table->increments('id_bd_dc_group_trans_bendahara');
            $table->integer('kd_group_trans');
            $table->string('nama_group', 100);

            $table->primary(['kd_group_trans'], 'pk_bd_dc_group_trans_bendahara');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bd_dc_group_trans_bendahara');
    }
};
