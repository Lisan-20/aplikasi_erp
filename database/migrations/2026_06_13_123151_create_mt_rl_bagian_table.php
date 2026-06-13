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
        Schema::create('mt_rl_bagian', function (Blueprint $table) {
            $table->increments('id_mt_rl_bagian');
            $table->string('kode_bagian', 20)->nullable();
            $table->string('rl_bagian')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_rl_bagian');
    }
};
