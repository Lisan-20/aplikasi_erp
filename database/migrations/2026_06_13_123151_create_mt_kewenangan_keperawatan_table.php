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
        Schema::create('mt_kewenangan_keperawatan', function (Blueprint $table) {
            $table->increments('id_kewenangan');
            $table->integer('id_kep')->nullable();
            $table->integer('id_pk')->nullable();
            $table->integer('kd_lev')->nullable();
            $table->integer('kd_periksa')->nullable();
            $table->integer('kd_ref')->nullable();
            $table->integer('kd_type')->nullable();
            $table->text('nm_kewenangan')->nullable();
            $table->string('nomor', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_kewenangan_keperawatan');
    }
};
