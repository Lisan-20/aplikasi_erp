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
        if (Schema::hasTable('mt_pph21')) {
            return;
        }

        Schema::create('mt_pph21', function (Blueprint $table) {
            $table->increments('id_dd_pph21');
            $table->decimal('pph21_dari', 19, 4)->nullable();
            $table->decimal('pph21_sampai', 19, 4)->nullable();
            $table->decimal('pph21_persen', 19, 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_pph21');
    }
};
