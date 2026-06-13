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
        Schema::create('icd9_procedures', function (Blueprint $table) {
            $table->string('Code', 10);
            $table->string('Code2', 10);
            $table->string('Description', 163)->nullable();
            $table->string('Class', 11)->nullable();
            $table->string('Inpatient', 23)->nullable();
            $table->string('Outpatient', 103)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('icd9_procedures');
    }
};
