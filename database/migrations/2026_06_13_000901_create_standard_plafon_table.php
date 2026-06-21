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
        if (Schema::hasTable('standard_plafon')) {
            return;
        }

        Schema::create('standard_plafon', function (Blueprint $table) {
            $table->increments('id_standard_plafon');
            $table->integer('kode_tarif')->nullable();
            $table->string('nama_tindakan', 100)->nullable();
            $table->decimal('tarif', 19, 4)->nullable();
            $table->integer('flag_kondisi')->nullable();
            $table->integer('klas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('standard_plafon');
    }
};
