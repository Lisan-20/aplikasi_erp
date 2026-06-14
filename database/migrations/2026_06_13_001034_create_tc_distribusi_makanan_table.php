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
        if (Schema::hasTable('tc_distribusi_makanan')) {
            return;
        }

        Schema::create('tc_distribusi_makanan', function (Blueprint $table) {
            $table->increments('id_dis');
            $table->dateTime('tgl_dis')->nullable();
            $table->char('id_user', 10)->nullable();
            $table->integer('id_gol')->nullable();
            $table->text('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_distribusi_makanan');
    }
};
