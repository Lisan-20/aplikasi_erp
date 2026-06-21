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
        if (Schema::hasTable('dd_bank')) {
            return;
        }

        Schema::create('dd_bank', function (Blueprint $table) {
            $table->increments('id_dd_bank');
            $table->string('nama_bank', 50)->nullable();
            $table->string('nama_bank_sink', 10)->nullable();
            $table->string('alamat', 100)->nullable();
            $table->string('kota', 50)->nullable();
            $table->integer('status_bank')->nullable()->comment('1 (aktif),9(tidak aktif)');
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->dateTime('status_tgl')->nullable();

            $table->primary(['id_dd_bank'], 'pk_dd_bank');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dd_bank');
    }
};
