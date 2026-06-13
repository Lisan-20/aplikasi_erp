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
        Schema::create('tbl_struktur_gigi', function (Blueprint $table) {
            $table->increments('id_st_gigi');
            $table->integer('no_gigi')->nullable();
            $table->string('image_gigi', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_struktur_gigi');
    }
};
