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
        if (Schema::hasTable('saldo_depo')) {
            return;
        }

        Schema::create('saldo_depo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_brg', 150)->nullable();
            $table->decimal('saldo', 18)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saldo_depo');
    }
};
