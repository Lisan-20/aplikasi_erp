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
        if (Schema::hasTable('tc_temp_regonline')) {
            return;
        }

        Schema::create('tc_temp_regonline', function (Blueprint $table) {
            $table->increments('id_temp');
            $table->string('no_mr', 50)->nullable();
            $table->dateTime('tgl_daftar_temp')->nullable();
            $table->string('hari', 50)->nullable();
            $table->date('tgl_daftar_temp1')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_temp_regonline');
    }
};
