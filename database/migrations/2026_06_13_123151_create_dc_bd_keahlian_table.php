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
        if (Schema::hasTable('dc_bd_keahlian')) {
            return;
        }

        Schema::create('dc_bd_keahlian', function (Blueprint $table) {
            $table->increments('id_dc_bd_keahlian');
            $table->string('nama_bidang', 50)->nullable();
            $table->string('keterangan', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_bd_keahlian');
    }
};
