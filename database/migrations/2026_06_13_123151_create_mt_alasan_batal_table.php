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
        Schema::create('mt_alasan_batal', function (Blueprint $table) {
            $table->increments('id_alasan_batal');
            $table->string('nama_alasan_batal', 100)->nullable();
            $table->string('flag_bagian', 1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_alasan_batal');
    }
};
