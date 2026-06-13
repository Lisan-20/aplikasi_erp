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
        if (Schema::hasTable('tbl_milik_detail')) {
            return;
        }

        Schema::create('tbl_milik_detail', function (Blueprint $table) {
            $table->integer('id_kode_milik')->nullable();
            $table->integer('kode_milik')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->string('kode_kepesertaan', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_milik_detail');
    }
};
