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
        Schema::create('mt_diet', function (Blueprint $table) {
            $table->increments('id_mt_diet');
            $table->string('kode_diet', 6);
            $table->string('nama_diet', 50)->nullable();
            $table->string('kode_kel', 3)->nullable();
            $table->string('no_urut', 6)->nullable();

            $table->primary(['kode_diet'], 'pk_mt_diet_3');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_diet');
    }
};
