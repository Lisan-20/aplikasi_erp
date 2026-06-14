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
        if (Schema::hasTable('tc_cppt_monitor')) {
            return;
        }

        Schema::create('tc_cppt_monitor', function (Blueprint $table) {
            $table->increments('id_ctk');
            $table->string('kd_t', 8)->nullable();
            $table->decimal('nilai_t', 19, 4)->nullable();
            $table->string('kd_n', 8)->nullable();
            $table->decimal('nilai_n', 19, 4)->nullable();
            $table->string('kd_p', 8)->nullable();
            $table->decimal('nilai_p', 19, 4)->nullable();
            $table->string('kd_s', 8)->nullable();
            $table->decimal('nilai_s', 19, 4)->nullable();
            $table->integer('jenis')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_cppt_monitor');
    }
};
