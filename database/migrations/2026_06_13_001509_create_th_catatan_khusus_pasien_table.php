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
        if (Schema::hasTable('th_catatan_khusus_pasien')) {
            return;
        }

        Schema::create('th_catatan_khusus_pasien', function (Blueprint $table) {
            $table->integer('id_catatan_khusus')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->string('bagian', 50)->nullable();
            $table->integer('id_user')->nullable();
            $table->text('catatan')->nullable();
            $table->string('no_mr', 50)->nullable();
            $table->integer('no_registrasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_catatan_khusus_pasien');
    }
};
