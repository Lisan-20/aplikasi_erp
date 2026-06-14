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
        if (Schema::hasTable('hsl_angket_rj')) {
            return;
        }

        Schema::create('hsl_angket_rj', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nama')->nullable();
            $table->string('nama_poli', 50)->nullable();
            $table->string('nama_asuransi', 50)->nullable();
            $table->integer('no_tlp')->nullable();
            $table->string('optradio1', 50)->nullable();
            $table->string('optradio2', 50)->nullable();
            $table->string('optradio3', 50)->nullable();
            $table->string('optradio4', 50)->nullable();
            $table->string('optradio5', 50)->nullable();
            $table->string('optradio6', 50)->nullable();
            $table->string('optradio7', 50)->nullable();
            $table->string('optradio8', 50)->nullable();
            $table->string('optradio9', 50)->nullable();
            $table->string('optradio10', 50)->nullable();
            $table->string('optradio11', 50)->nullable();
            $table->dateTime('tanggal')->nullable();
            $table->bigInteger('no_mr2')->nullable();
            $table->string('no_mr', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hsl_angket_rj');
    }
};
