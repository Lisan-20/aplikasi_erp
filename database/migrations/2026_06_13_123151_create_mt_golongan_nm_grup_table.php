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
        if (Schema::hasTable('mt_golongan_nm_grup')) {
            return;
        }

        Schema::create('mt_golongan_nm_grup', function (Blueprint $table) {
            $table->increments('id_map');
            $table->char('map_jurnal', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_golongan_nm_grup');
    }
};
