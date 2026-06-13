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
        if (Schema::hasTable('dc_grup_kualifikasi_pend')) {
            return;
        }

        Schema::create('dc_grup_kualifikasi_pend', function (Blueprint $table) {
            $table->increments('kd_grup_kualifikasi');
            $table->string('nama_grup', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_grup_kualifikasi_pend');
    }
};
