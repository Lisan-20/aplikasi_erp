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
        if (Schema::hasTable('mt_jenis_tindakan')) {
            return;
        }

        Schema::create('mt_jenis_tindakan', function (Blueprint $table) {
            $table->integer('kode_jenis_tindakan');
            $table->string('jenis_tindakan', 100)->nullable();
            $table->integer('kode')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_jenis_tindakan');
    }
};
