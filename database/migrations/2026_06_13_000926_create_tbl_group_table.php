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
        if (Schema::hasTable('tbl_group')) {
            return;
        }

        Schema::create('tbl_group', function (Blueprint $table) {
            $table->integer('id_group');
            $table->string('nama_group', 50)->nullable();

            $table->primary(['id_group'], 'pk_tbl_group');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_group');
    }
};
