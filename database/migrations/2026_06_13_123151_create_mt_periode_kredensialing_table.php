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
        Schema::create('mt_periode_kredensialing', function (Blueprint $table) {
            $table->increments('id_periode');
            $table->string('periode_kredensialing', 20)->nullable();
            $table->dateTime('periode_awal')->nullable();
            $table->dateTime('periode_akhir')->nullable();
            $table->string('periode_ket', 250)->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->dateTime('status_tgl')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_periode_kredensialing');
    }
};
