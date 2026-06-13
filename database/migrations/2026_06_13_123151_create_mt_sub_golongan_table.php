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
        if (Schema::hasTable('mt_sub_golongan')) {
            return;
        }

        Schema::create('mt_sub_golongan', function (Blueprint $table) {
            $table->string('kode_sub_gol', 4);
            $table->string('nama_sub_golongan', 250);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_sub_golongan');
    }
};
