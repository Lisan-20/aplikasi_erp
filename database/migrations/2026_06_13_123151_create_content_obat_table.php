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
        Schema::create('content_obat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode', 20)->nullable();
            $table->string('nama_brg', 50)->nullable();
            $table->string('supplier', 50)->nullable();
            $table->integer('content')->nullable();
            $table->string('satuan', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_obat');
    }
};
