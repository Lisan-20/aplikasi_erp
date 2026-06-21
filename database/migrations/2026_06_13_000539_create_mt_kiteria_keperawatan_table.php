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
        if (Schema::hasTable('mt_kiteria_keperawatan')) {
            return;
        }

        Schema::create('mt_kiteria_keperawatan', function (Blueprint $table) {
            $table->increments('id_kriteria');
            $table->integer('id_kep')->nullable();
            $table->integer('id_pk')->nullable();
            $table->text('nm_kriteria')->nullable();
            $table->integer('no_urut')->nullable();
            $table->integer('narasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_kiteria_keperawatan');
    }
};
