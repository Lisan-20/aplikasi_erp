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
        Schema::create('mt_generik', function (Blueprint $table) {
            $table->string('kode_generik', 50);
            $table->string('nama_generik', 250)->nullable();
            $table->string('kfa_code', 50)->nullable();

            $table->primary(['kode_generik'], 'pk_mt_generik_annisa_1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_generik');
    }
};
