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
        Schema::create('mt_harga_beli', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_brg', 250)->nullable();
            $table->decimal('hna', 18)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_harga_beli');
    }
};
