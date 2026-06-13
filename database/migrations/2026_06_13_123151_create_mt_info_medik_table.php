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
        Schema::create('mt_info_medik', function (Blueprint $table) {
            $table->increments('id_info_medik');
            $table->string('peyakit', 100)->nullable();
            $table->string('penyebab')->nullable();
            $table->string('ciri')->nullable();
            $table->string('cegah')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_info_medik');
    }
};
