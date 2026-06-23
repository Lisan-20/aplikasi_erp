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
        Schema::table('mt_erp_supplier', function (Blueprint $table) {
            $table->unsignedBigInteger('provinsi_id')->nullable()->after('provinsi');
            $table->unsignedBigInteger('kota_id')->nullable()->after('provinsi_id');
            // We won't add foreign key constraints for now to prevent issues with existing data
            // but we add indices for performance.
            $table->index('provinsi_id');
            $table->index('kota_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mt_erp_supplier', function (Blueprint $table) {
            $table->dropIndex(['provinsi_id']);
            $table->dropIndex(['kota_id']);
            $table->dropColumn(['provinsi_id', 'kota_id']);
        });
    }
};
