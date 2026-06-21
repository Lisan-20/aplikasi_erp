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
        if (Schema::hasTable('mt_pabrik_nm')) {
            return;
        }

        Schema::create('mt_pabrik_nm', function (Blueprint $table) {
            $table->integer('id_pabrik');
            $table->string('kode_pabrik', 50)->nullable();
            $table->string('nama_pabrik', 20)->nullable();
            $table->string('keterangan', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_pabrik_nm');
    }
};
