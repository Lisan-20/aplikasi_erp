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
        if (Schema::hasTable('tbl_proses_posting')) {
            return;
        }

        Schema::create('tbl_proses_posting', function (Blueprint $table) {
            $table->integer('id_tbl');
            $table->integer('bulan')->nullable();
            $table->integer('tahun')->nullable();
            $table->integer('flag')->nullable();
            $table->dateTime('tgl_posting')->nullable();
            $table->integer('id_user')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_proses_posting');
    }
};
