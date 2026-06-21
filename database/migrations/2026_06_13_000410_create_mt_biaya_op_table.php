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
        if (Schema::hasTable('mt_biaya_op')) {
            return;
        }

        Schema::create('mt_biaya_op', function (Blueprint $table) {
            $table->integer('kode_biaya');
            $table->string('nama_biaya')->nullable();
            $table->integer('kode_ref');
            $table->string('referensi')->nullable();
            $table->integer('persen')->nullable();
            $table->integer('periode')->nullable();
            $table->string('rumus')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_biaya_op');
    }
};
