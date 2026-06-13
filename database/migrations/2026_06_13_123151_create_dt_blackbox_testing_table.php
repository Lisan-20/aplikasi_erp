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
        Schema::create('dt_blackbox_testing', function (Blueprint $table) {
            $table->increments('id_bt');
            $table->string('modul_aplikasi', 100)->nullable();
            $table->string('menu_aplikasi', 100)->nullable();
            $table->string('sub_menu_palikasi', 100)->nullable();
            $table->string('url', 250)->nullable();
            $table->string('status_test', 50)->nullable();
            $table->string('respon_time', 50)->nullable();
            $table->text('keterangan')->nullable();
            $table->string('qc_name', 100)->nullable();
            $table->dateTime('test_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dt_blackbox_testing');
    }
};
