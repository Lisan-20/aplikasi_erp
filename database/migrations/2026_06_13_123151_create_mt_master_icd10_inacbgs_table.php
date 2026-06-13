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
        Schema::create('mt_master_icd10_inacbgs', function (Blueprint $table) {
            $table->float('no', 53, 0)->nullable();
            $table->float('urut', 53, 0)->nullable();
            $table->string('grup')->nullable();
            $table->string('icd_x_ok')->nullable();
            $table->string('icd_x')->nullable();
            $table->string('diagnosa')->nullable();
            $table->float('severity', 53, 0)->nullable();
            $table->string('inp')->nullable();
            $table->string('out')->nullable();
            $table->string('inacbg_inp')->nullable();
            $table->string('inacbg_out', 225)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_master_icd10_inacbgs');
    }
};
