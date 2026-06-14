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
        if (Schema::hasTable('mt_rumus_oksigen')) {
            return;
        }

        Schema::create('mt_rumus_oksigen', function (Blueprint $table) {
            $table->increments('id_mt_rumus');
            $table->integer('variable_1')->nullable();
            $table->integer('variable_2')->nullable();
            $table->decimal('bhp', 18, 0)->nullable();
            $table->decimal('harga_jual', 18, 0)->nullable();
            $table->integer('variable_3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_rumus_oksigen');
    }
};
