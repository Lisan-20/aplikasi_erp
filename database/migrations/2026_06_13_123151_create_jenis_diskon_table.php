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
        Schema::create('jenis_diskon', function (Blueprint $table) {
            $table->increments('id_jenis_diskon');
            $table->string('nama_diskon', 50)->nullable();
            $table->integer('jenis_diskon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_diskon');
    }
};
