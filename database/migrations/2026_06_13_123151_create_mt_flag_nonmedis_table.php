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
        Schema::create('mt_flag_nonmedis', function (Blueprint $table) {
            $table->string('id_flag_medis', 2);
            $table->string('nama_flag_medis', 50)->nullable();

            $table->primary(['id_flag_medis'], 'pk_mt_flag_nonmedis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_flag_nonmedis');
    }
};
