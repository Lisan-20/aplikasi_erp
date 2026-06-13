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
        Schema::create('dd_group_modul', function (Blueprint $table) {
            $table->increments('id_dd_group_modul');
            $table->integer('id_dd_user')->nullable();
            $table->integer('id_dc_modul')->nullable();
            $table->integer('hak_akses')->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();

            $table->primary(['id_dd_group_modul'], 'pk_dd_group_modul');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dd_group_modul');
    }
};
