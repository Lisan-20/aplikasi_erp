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
        Schema::create('dc_level_struktur_org', function (Blueprint $table) {
            $table->increments('id_level_struktur_org');
            $table->string('kode_level_org', 2)->nullable();
            $table->string('nama_level', 50)->nullable();
            $table->string('keterangan', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_level_struktur_org');
    }
};
