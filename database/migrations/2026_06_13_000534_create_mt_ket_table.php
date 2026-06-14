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
        if (Schema::hasTable('mt_ket')) {
            return;
        }

        Schema::create('mt_ket', function (Blueprint $table) {
            $table->integer('kode_ket');
            $table->string('keterangan', 50)->nullable();

            $table->primary(['kode_ket'], 'pk_mt_ket');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_ket');
    }
};
