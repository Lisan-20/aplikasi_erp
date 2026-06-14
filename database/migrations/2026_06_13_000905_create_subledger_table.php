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
        if (Schema::hasTable('subledger')) {
            return;
        }

        Schema::create('subledger', function (Blueprint $table) {
            $table->integer('id_subledger');
            $table->string('subledger', 2);
            $table->string('nama_subledger', 50)->nullable();

            $table->primary(['id_subledger'], 'pk_subledger');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subledger');
    }
};
