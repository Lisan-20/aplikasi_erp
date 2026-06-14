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
        if (Schema::hasTable('tbl_kel_penilaian')) {
            return;
        }

        Schema::create('tbl_kel_penilaian', function (Blueprint $table) {
            $table->increments('id_kel_penilaian');
            $table->text('kel_penilaian')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_kel_penilaian');
    }
};
