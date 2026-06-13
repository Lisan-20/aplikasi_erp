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
        Schema::create('mt_parameter_test', function (Blueprint $table) {
            $table->increments('id');
            $table->string('param_name', 50)->nullable();
            $table->string('param_value', 50)->nullable();
            $table->string('param_code', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_parameter_test');
    }
};
