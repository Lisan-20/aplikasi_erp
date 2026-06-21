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
        if (Schema::hasTable('tbl_milik')) {
            return;
        }

        Schema::create('tbl_milik', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kode_milik')->nullable();
            $table->string('nama_milik', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_milik');
    }
};
