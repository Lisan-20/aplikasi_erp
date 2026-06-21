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
        if (Schema::hasTable('tc_odontogram')) {
            return;
        }

        Schema::create('tc_odontogram', function (Blueprint $table) {
            $table->increments('id_odontogram');
            $table->integer('no_registrasi')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('kode_dokter')->nullable();
            $table->string('file_gambar', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_odontogram');
    }
};
