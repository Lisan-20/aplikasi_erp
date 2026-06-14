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
        if (Schema::hasTable('tb_ket_sehat')) {
            return;
        }

        Schema::create('tb_ket_sehat', function (Blueprint $table) {
            $table->increments('id_sehat');
            $table->string('ket_sehat', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_ket_sehat');
    }
};
