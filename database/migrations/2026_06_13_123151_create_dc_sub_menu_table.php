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
        Schema::create('dc_sub_menu', function (Blueprint $table) {
            $table->increments('id_dc_sub_menu');
            $table->integer('id_dc_menu')->nullable();
            $table->string('nama_sub_menu', 50)->nullable();
            $table->string('url_sub_menu')->nullable();
            $table->string('keterangan', 100)->nullable();
            $table->integer('no_urut')->nullable();
            $table->tinyInteger('status_sub_menu')->nullable()->default(0);
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->text('summary')->nullable();

            $table->primary(['id_dc_sub_menu'], 'pk_dc_sub_menu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_sub_menu');
    }
};
