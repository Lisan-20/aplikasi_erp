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
        Schema::create('tc_visit_apoteker', function (Blueprint $table) {
            $table->increments('id_visit_apt');
            $table->integer('no_mr')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->text('ket_visit')->nullable();
            $table->integer('id_user')->nullable();
            $table->dateTime('tgl_input')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_visit_apoteker');
    }
};
