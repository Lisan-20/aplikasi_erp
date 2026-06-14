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
        if (Schema::hasTable('dc_agama')) {
            return;
        }

        Schema::create('dc_agama', function (Blueprint $table) {
            $table->increments('id_dc_agama');
            $table->string('agama', 50)->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->dateTime('status_tgl')->nullable();
            $table->integer('kode_agama')->nullable();

            $table->primary(['id_dc_agama'], 'pk__dc_agama__075714dc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_agama');
    }
};
