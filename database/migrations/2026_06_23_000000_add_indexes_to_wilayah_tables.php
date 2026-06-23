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
        Schema::table('mt_erp_provinsi', function (Blueprint $table) {
            $table->index('nama_provinsi');
            $table->index('negara_id');
        });

        Schema::table('mt_erp_kota', function (Blueprint $table) {
            $table->index('nama_kota');
            $table->index('provinsi_id');
        });

        Schema::table('mt_erp_kecamatan', function (Blueprint $table) {
            $table->index('nama_kecamatan');
            $table->index('kota_id');
        });

        Schema::table('mt_erp_kelurahan', function (Blueprint $table) {
            $table->index('nama_kelurahan');
            $table->index('kecamatan_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mt_erp_kelurahan', function (Blueprint $table) {
            $table->dropIndex(['nama_kelurahan']);
            $table->dropIndex(['kecamatan_id']);
        });

        Schema::table('mt_erp_kecamatan', function (Blueprint $table) {
            $table->dropIndex(['nama_kecamatan']);
            $table->dropIndex(['kota_id']);
        });

        Schema::table('mt_erp_kota', function (Blueprint $table) {
            $table->dropIndex(['nama_kota']);
            $table->dropIndex(['provinsi_id']);
        });

        Schema::table('mt_erp_provinsi', function (Blueprint $table) {
            $table->dropIndex(['nama_provinsi']);
            $table->dropIndex(['negara_id']);
        });
    }
};
