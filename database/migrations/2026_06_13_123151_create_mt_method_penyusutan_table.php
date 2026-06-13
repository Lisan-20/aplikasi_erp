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
        Schema::create('mt_method_penyusutan', function (Blueprint $table) {
            $table->increments('id_meth_asset');
            $table->integer('id_method')->nullable();
            $table->string('nama_method', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_method_penyusutan');
    }
};
