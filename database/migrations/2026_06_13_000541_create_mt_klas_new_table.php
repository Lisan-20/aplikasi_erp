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
        if (Schema::hasTable('mt_klas_new')) {
            return;
        }

        Schema::create('mt_klas_new', function (Blueprint $table) {
            $table->integer('kode_klas');
            $table->string('nama_klas', 50)->nullable();
            $table->string('kode_annisa', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_klas_new');
    }
};
