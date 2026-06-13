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
        Schema::create('supplier_cash', function (Blueprint $table) {
            $table->integer('kodesupplier')->nullable();
            $table->string('nama_supplier', 250)->nullable();
            $table->text('alamat')->nullable();
            $table->string('telpon', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_cash');
    }
};
