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
        Schema::create('saldo_awal_hutang', function (Blueprint $table) {
            $table->increments('kd_saldo_awal_hutang');
            $table->dateTime('tgl_input')->nullable();
            $table->dateTime('tgl_saldo_awal')->nullable();
            $table->integer('kodesupplier')->nullable();
            $table->dateTime('tgl_jt')->nullable();
            $table->decimal('saldo_awal', 15)->nullable();
            $table->integer('no_induk')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saldo_awal_hutang');
    }
};
