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
        Schema::create('tbl_harga_supplier', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_brg', 50)->nullable();
            $table->integer('kode_supplier')->nullable();
            $table->decimal('harga', 19, 4)->nullable();
            $table->decimal('harga_plus_ppn', 19, 4)->nullable();
            $table->string('satuan', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_harga_supplier');
    }
};
