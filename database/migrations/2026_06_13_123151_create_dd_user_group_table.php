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
        Schema::create('dd_user_group', function (Blueprint $table) {
            $table->increments('id_dd_user_group');
            $table->string('nama_group', 100)->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();

            $table->primary(['id_dd_user_group'], 'pk_dd_user_group');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dd_user_group');
    }
};
