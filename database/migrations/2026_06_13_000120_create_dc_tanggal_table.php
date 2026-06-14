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
        if (Schema::hasTable('dc_tanggal')) {
            return;
        }

        Schema::create('dc_tanggal', function (Blueprint $table) {
            $table->integer('id_tgl')->nullable();
            $table->integer('tanggal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_tanggal');
    }
};
