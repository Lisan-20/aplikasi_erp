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
        Schema::create('mt_penyelenggara_diklat', function (Blueprint $table) {
            $table->increments('id_pen');
            $table->string('nama_penyelenggaran', 250)->nullable();
            $table->integer('id_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_penyelenggara_diklat');
    }
};
