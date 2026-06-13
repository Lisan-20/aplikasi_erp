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
        if (Schema::hasTable('tc_kredensialing_sertifikat')) {
            return;
        }

        Schema::create('tc_kredensialing_sertifikat', function (Blueprint $table) {
            $table->increments('id_kred_ser');
            $table->integer('id_kred')->nullable();
            $table->integer('id_tc_sertifikat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_kredensialing_sertifikat');
    }
};
