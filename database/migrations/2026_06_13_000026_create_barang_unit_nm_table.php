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
        if (Schema::hasTable('barang_unit_nm')) {
            return;
        }

        Schema::create('barang_unit_nm', function (Blueprint $table) {
            $table->char('no', 10)->nullable();
            $table->string('brg', 70)->nullable();
            $table->string('bagian', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_unit_nm');
    }
};
