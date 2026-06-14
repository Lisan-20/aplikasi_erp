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
        if (Schema::hasTable('tc_solusi')) {
            return;
        }

        Schema::create('tc_solusi', function (Blueprint $table) {
            $table->integer('id_solusi');
            $table->integer('id_report')->nullable();
            $table->dateTime('tgl_solusi')->nullable();
            $table->text('isi')->nullable();
            $table->text('pengirim_sol')->nullable();
            $table->text('solusi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_solusi');
    }
};
