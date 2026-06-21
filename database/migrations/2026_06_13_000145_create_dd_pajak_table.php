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
        if (Schema::hasTable('dd_pajak')) {
            return;
        }

        Schema::create('dd_pajak', function (Blueprint $table) {
            $table->increments('id_dd_pajak');
            $table->decimal('PTKP_pribadi', 19, 4)->nullable();
            $table->decimal('PTKP_istri', 19, 4)->nullable();
            $table->decimal('PTKP_anak', 19, 4)->nullable();
            $table->integer('mak_anak')->nullable();
            $table->decimal('mak_biaya_jab', 19, 4)->nullable();
            $table->decimal('persen_biaya_jab', 19, 4)->nullable();
            $table->decimal('PPh21_ekpat', 19, 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dd_pajak');
    }
};
