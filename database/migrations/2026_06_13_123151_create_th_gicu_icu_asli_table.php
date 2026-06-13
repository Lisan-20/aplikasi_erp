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
        Schema::create('th_gicu_icu_asli', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('no_registrasi')->nullable();
            $table->string('no_mr', 50)->nullable();
            $table->string('kode_pemeriksaan', 50)->nullable();
            $table->text('note_1')->nullable();
            $table->text('note_2')->nullable();
            $table->text('note_3')->nullable();
            $table->text('note_4')->nullable();
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
            $table->text('part17')->nullable();
            $table->text('part18')->nullable();
            $table->text('part19')->nullable();
            $table->text('part20')->nullable();
            $table->text('part21')->nullable();
            $table->text('part22')->nullable();
            $table->text('part23')->nullable();
            $table->text('part24')->nullable();
            $table->string('kode_pemeriksaan_det', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_gicu_icu_asli');
    }
};
