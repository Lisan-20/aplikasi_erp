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
        Schema::table('dc_kota', function (Blueprint $table) {
            $table->foreign(['id_dc_propinsi'], 'FK_dc_kota_dc_propinsi')->references(['id_dc_propinsi'])->on('dc_propinsi')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dc_kota', function (Blueprint $table) {
            $table->dropForeign('FK_dc_kota_dc_propinsi');
        });
    }
};
