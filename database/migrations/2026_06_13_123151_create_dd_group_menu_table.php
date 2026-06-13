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
        if (Schema::hasTable('dd_group_menu')) {
            return;
        }

        Schema::create('dd_group_menu', function (Blueprint $table) {
            $table->increments('id_dd_group_menu');
            $table->integer('id_dd_user');
            $table->integer('id_dc_menu')->nullable();
            $table->integer('hak_akses')->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();

            $table->primary(['id_dd_group_menu'], 'pk_mt_group_menu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dd_group_menu');
    }
};
