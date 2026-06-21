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
        if (Schema::hasTable('mt_golongan_tagih')) {
            return;
        }

        Schema::create('mt_golongan_tagih', function (Blueprint $table) {
            $table->increments('id_mt_golongan_tagih');
            $table->string('nama_golongan', 30)->nullable();
            $table->integer('kode_golongan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_golongan_tagih');
    }
};
