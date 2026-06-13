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
        Schema::create('mt_keadaan_gigi', function (Blueprint $table) {
            $table->increments('id_keadaan');
            $table->string('singkatan', 4)->nullable();
            $table->string('arti', 50)->nullable();
            $table->string('keterangan', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_keadaan_gigi');
    }
};
