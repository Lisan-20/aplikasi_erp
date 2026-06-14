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
        if (Schema::hasTable('dd_warna')) {
            return;
        }

        Schema::create('dd_warna', function (Blueprint $table) {
            $table->increments('id_dd_warna');
            $table->string('warna', 6);
            $table->string('ket_warna', 10)->nullable();
            $table->integer('id_bmmt_penyewa')->nullable();
            $table->tinyInteger('status_tenant')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dd_warna');
    }
};
