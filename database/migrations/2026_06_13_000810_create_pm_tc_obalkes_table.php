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
        if (Schema::hasTable('pm_tc_obalkes')) {
            return;
        }

        Schema::create('pm_tc_obalkes', function (Blueprint $table) {
            $table->integer('id_pm_tc_obalkes');
            $table->integer('kode_penunjang')->nullable();
            $table->string('kode_brg', 50)->nullable();
            $table->integer('kode_tarif')->nullable();
            $table->integer('volume')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('petugas')->nullable();
            $table->decimal('harga_beli', 18, 0)->nullable();
            $table->decimal('harga_jual', 18, 0)->nullable();

            $table->primary(['id_pm_tc_obalkes'], 'pk_pm_tc_obalkes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_tc_obalkes');
    }
};
