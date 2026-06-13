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
        Schema::create('group_trans_bendahara', function (Blueprint $table) {
            $table->integer('id_group_trans_bendahara');
            $table->integer('kd_group_trans');
            $table->string('acc_no', 50)->nullable();
            $table->string('nama_group', 100);
            $table->string('int', 1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_trans_bendahara');
    }
};
