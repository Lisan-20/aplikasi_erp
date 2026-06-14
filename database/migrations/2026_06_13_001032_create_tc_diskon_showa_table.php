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
        if (Schema::hasTable('tc_diskon_showa')) {
            return;
        }

        Schema::create('tc_diskon_showa', function (Blueprint $table) {
            $table->integer('no_registrasi')->nullable();
            $table->decimal('diskon', 18)->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->decimal('diskon_persen', 18)->nullable();
            $table->decimal('billing', 18)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_diskon_showa');
    }
};
