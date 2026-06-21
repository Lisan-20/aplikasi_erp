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
        if (Schema::hasTable('tb_jenis_dpjp')) {
            return;
        }

        Schema::create('tb_jenis_dpjp', function (Blueprint $table) {
            $table->integer('kode_jenis_dpjp');
            $table->string('nama_jenis_dpjp', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_jenis_dpjp');
    }
};
