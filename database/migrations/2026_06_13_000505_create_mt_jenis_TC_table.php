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
        if (Schema::hasTable('mt_jenis_TC')) {
            return;
        }

        Schema::create('mt_jenis_TC', function (Blueprint $table) {
            $table->increments('no');
            $table->string('nama_jenis', 250)->nullable();
            $table->integer('flag')->nullable();
            $table->decimal('harga_total', 19, 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_jenis_TC');
    }
};
