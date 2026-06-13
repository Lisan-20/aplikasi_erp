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
        if (Schema::hasTable('dd_hari')) {
            return;
        }

        Schema::create('dd_hari', function (Blueprint $table) {
            $table->integer('id_dd_hari');
            $table->string('nama_hari', 10)->nullable();

            $table->primary(['id_dd_hari'], 'pk_tbl_hari');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dd_hari');
    }
};
