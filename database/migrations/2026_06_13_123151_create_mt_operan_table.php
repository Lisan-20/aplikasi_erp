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
        Schema::create('mt_operan', function (Blueprint $table) {
            $table->increments('id_mt_operan');
            $table->string('isi', 1000)->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('id_dd_user')->nullable();
            $table->integer('status_aktif')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_operan');
    }
};
