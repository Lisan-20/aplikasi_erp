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
        if (Schema::hasTable('mt_jenis_anestesi')) {
            return;
        }

        Schema::create('mt_jenis_anestesi', function (Blueprint $table) {
            $table->integer('kode');
            $table->string('jenis_anestesi', 50)->nullable();

            $table->primary(['kode'], 'pk_mt_jenis_anestesi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_jenis_anestesi');
    }
};
