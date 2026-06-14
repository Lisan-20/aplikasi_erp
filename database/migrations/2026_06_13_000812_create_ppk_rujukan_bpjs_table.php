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
        if (Schema::hasTable('ppk_rujukan_bpjs')) {
            return;
        }

        Schema::create('ppk_rujukan_bpjs', function (Blueprint $table) {
            $table->increments('kd');
            $table->string('ppkRujukan', 50)->nullable();
            $table->string('NamaRujukan', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppk_rujukan_bpjs');
    }
};
