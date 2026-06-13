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
        Schema::create('mt_pabrik', function (Blueprint $table) {
            $table->integer('id_pabrik');
            $table->string('kode_pabrik', 50)->nullable();
            $table->string('nama_pabrik', 20)->nullable();
            $table->string('keterangan', 20)->nullable();

            $table->primary(['id_pabrik'], 'pk__mt_pabrik__503293d2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_pabrik');
    }
};
