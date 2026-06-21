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
        if (Schema::hasTable('alt_diagnosis')) {
            return;
        }

        Schema::create('alt_diagnosis', function (Blueprint $table) {
            $table->integer('chapter')->nullable();
            $table->string('s1', 3)->nullable();
            $table->string('code', 5);
            $table->string('code2', 6)->nullable();
            $table->text('description')->nullable();
            $table->integer('severity')->nullable();
            $table->text('Inpatient')->nullable();
            $table->text('Outpatient')->nullable();
            $table->string('Inpatient2', 50)->nullable();
            $table->string('Outpatient2', 50)->nullable();
            $table->text('Inpatient1')->nullable();
            $table->text('Outpatient1')->nullable();
            $table->text('description1')->nullable();
            $table->string('inacbg_inp', 50)->nullable();
            $table->string('inacbg_in')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alt_diagnosis');
    }
};
