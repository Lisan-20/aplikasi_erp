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
        if (Schema::hasTable('L_Rugi_biaya_mapping')) {
            return;
        }

        Schema::create('L_Rugi_biaya_mapping', function (Blueprint $table) {
            $table->integer('id_biaya')->nullable();
            $table->string('ket_biaya', 250)->nullable();
            $table->integer('ref')->nullable();
            $table->integer('lev')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('L_Rugi_biaya_mapping');
    }
};
