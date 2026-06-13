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
        if (Schema::hasTable('th_pengawasan_his_depan')) {
            return;
        }

        Schema::create('th_pengawasan_his_depan', function (Blueprint $table) {
            $table->integer('no_registrasi')->nullable();
            $table->string('kode_his', 5)->nullable();
            $table->integer('kode_dokter')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_pengawasan_his_depan');
    }
};
