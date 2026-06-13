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
        Schema::create('mt_rl_31', function (Blueprint $table) {
            $table->increments('id_rl_31');
            $table->string('nama_pelayanan', 50)->nullable();
            $table->char('kode_pelayanan', 200)->nullable();
            $table->integer('no_urut')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_rl_31');
    }
};
