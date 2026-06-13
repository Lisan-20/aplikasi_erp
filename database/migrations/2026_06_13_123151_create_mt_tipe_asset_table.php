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
        Schema::create('mt_tipe_asset', function (Blueprint $table) {
            $table->increments('id_tipe_asset');
            $table->string('nama_tipe', 100)->nullable();
            $table->string('acc_tipe', 10)->nullable();
            $table->string('acc_d', 10)->nullable();
            $table->string('acc_k', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_tipe_asset');
    }
};
