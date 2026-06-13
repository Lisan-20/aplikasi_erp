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
        Schema::create('tc_nomer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nomer')->nullable();
            $table->string('no_kunjungan', 10)->nullable();
            $table->dateTime('tanggal')->nullable();

            $table->primary(['id'], 'pk_tc_nomer_brr');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_nomer');
    }
};
