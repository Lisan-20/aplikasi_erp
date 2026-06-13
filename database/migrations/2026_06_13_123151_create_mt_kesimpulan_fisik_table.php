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
        Schema::create('mt_kesimpulan_fisik', function (Blueprint $table) {
            $table->integer('id_mt_kesimpulan');
            $table->integer('kode_pemeriksaan');
            $table->string('kesimpulan', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_kesimpulan_fisik');
    }
};
