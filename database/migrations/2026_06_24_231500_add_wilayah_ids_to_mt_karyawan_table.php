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
        Schema::table('mt_karyawan', function (Blueprint $table) {
            $table->string('provinsi_id', 50)->nullable()->after('provinsi');
            $table->string('kota_id', 50)->nullable()->after('kota');
            $table->string('kecamatan_id', 50)->nullable()->after('kecamatan');
            $table->string('kelurahan_id', 50)->nullable()->after('kelurahan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mt_karyawan', function (Blueprint $table) {
            $table->dropColumn(['provinsi_id', 'kota_id', 'kecamatan_id', 'kelurahan_id']);
        });
    }
};
