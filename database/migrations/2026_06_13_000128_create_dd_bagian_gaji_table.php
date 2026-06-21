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
        if (Schema::hasTable('dd_bagian_gaji')) {
            return;
        }

        Schema::create('dd_bagian_gaji', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->string('kode_bagian_gaji', 50)->nullable();
            $table->string('nama_bagian', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dd_bagian_gaji');
    }
};
