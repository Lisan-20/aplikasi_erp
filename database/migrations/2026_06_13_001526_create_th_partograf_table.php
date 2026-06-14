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
        if (Schema::hasTable('th_partograf')) {
            return;
        }

        Schema::create('th_partograf', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('no_registrasi')->nullable();
            $table->string('no_mr', 50)->nullable();
            $table->string('kode_pemeriksaan', 50)->nullable();
            $table->text('part1')->nullable();
            $table->text('part2')->nullable();
            $table->text('part3')->nullable();
            $table->text('part4')->nullable();
            $table->text('part5')->nullable();
            $table->text('part6')->nullable();
            $table->text('part7')->nullable();
            $table->text('part8')->nullable();
            $table->text('part9')->nullable();
            $table->text('part10')->nullable();
            $table->text('part11')->nullable();
            $table->text('part12')->nullable();
            $table->text('part13')->nullable();
            $table->text('part14')->nullable();
            $table->text('part15')->nullable();
            $table->text('part16')->nullable();
            $table->text('keterangan')->nullable();
            $table->text('part1_1')->nullable();
            $table->text('part2_1')->nullable();
            $table->text('part3_1')->nullable();
            $table->text('part4_1')->nullable();
            $table->text('part5_1')->nullable();
            $table->text('part6_1')->nullable();
            $table->text('part7_1')->nullable();
            $table->text('part8_1')->nullable();
            $table->text('part9_1')->nullable();
            $table->text('part10_1')->nullable();
            $table->text('part11_1')->nullable();
            $table->text('part12_1')->nullable();
            $table->text('part14_1')->nullable();
            $table->text('part15_1')->nullable();
            $table->text('part16_1')->nullable();
            $table->string('kode_pemeriksaan_det', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_partograf');
    }
};
