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
        Schema::create('rg_tc_rujukan_2024', function (Blueprint $table) {
            $table->integer('kode_rujukan')->nullable();
            $table->string('rujukan_dari', 18)->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->integer('no_kunjungan_lama')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->tinyInteger('status')->nullable()->default(0);
            $table->dateTime('tgl_input')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rg_tc_rujukan_2024');
    }
};
