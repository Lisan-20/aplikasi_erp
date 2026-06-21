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
        if (Schema::hasTable('dd_group_sie')) {
            return;
        }

        Schema::create('dd_group_sie', function (Blueprint $table) {
            $table->increments('id_group');
            $table->string('nama_group', 50)->nullable();
            $table->string('keterangan_group')->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->integer('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dd_group_sie');
    }
};
