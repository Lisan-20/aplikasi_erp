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
        Schema::create('dd_parameter_akuntansi', function (Blueprint $table) {
            $table->integer('id_parameter_akuntansi');
            $table->string('nama_parameter')->nullable();
            $table->string('nilai_parameter')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dd_parameter_akuntansi');
    }
};
