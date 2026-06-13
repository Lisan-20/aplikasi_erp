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
        if (Schema::hasTable('refdiagnosis')) {
            return;
        }

        Schema::create('refdiagnosis', function (Blueprint $table) {
            $table->string('Code', 30)->nullable();
            $table->text('Description')->nullable();
            $table->text('Severity')->nullable();
            $table->text('InPatient')->nullable();
            $table->text('OutPatient')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refdiagnosis');
    }
};
