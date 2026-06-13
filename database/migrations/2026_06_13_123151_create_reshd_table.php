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
        if (Schema::hasTable('reshd')) {
            return;
        }

        Schema::create('reshd', function (Blueprint $table) {
            $table->string('ID', 30);
            $table->string('PID', 13)->nullable();
            $table->string('APID', 16)->nullable();
            $table->string('PNAME', 50)->nullable();
            $table->string('ONO', 20);
            $table->string('LNO', 20)->nullable();
            $table->string('REQUEST_DT', 14)->nullable();
            $table->string('SOURCE_CD', 6)->nullable();
            $table->string('SOURCE_NM', 50)->nullable();
            $table->string('CLINICIAN_CD', 9)->nullable();
            $table->string('CLINICIAN_NM', 50)->nullable();
            $table->string('PRIORITY', 1)->nullable();
            $table->string('COMMENT', 300)->nullable();
            $table->string('VISITNO', 20)->nullable();
            $table->integer('FLAG_KIRIM')->nullable();

            $table->primary(['ID', 'ONO']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reshd');
    }
};
