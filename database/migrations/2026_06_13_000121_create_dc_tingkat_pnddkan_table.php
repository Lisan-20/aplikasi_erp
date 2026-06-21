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
        if (Schema::hasTable('dc_tingkat_pnddkan')) {
            return;
        }

        Schema::create('dc_tingkat_pnddkan', function (Blueprint $table) {
            $table->increments('id_dc_tingkat_pnddkan');
            $table->string('tingkat_pnddkan', 50)->nullable();

            $table->primary(['id_dc_tingkat_pnddkan'], 'pk_dc_tingkat_pnddkan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_tingkat_pnddkan');
    }
};
