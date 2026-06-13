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
        if (Schema::hasTable('mt_harga_menu')) {
            return;
        }

        Schema::create('mt_harga_menu', function (Blueprint $table) {
            $table->increments('id_mt_harga_menu');
            $table->integer('kode_klas')->nullable();
            $table->decimal('harga', 19, 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_harga_menu');
    }
};
