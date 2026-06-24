<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // For SQL Server we might need to use raw SQL if changing from int to varchar directly is problematic,
        // but Laravel schema builder usually handles it if we have doctrine/dbal installed.
        // Let's use raw SQL to be safe and avoid doctrine errors.
        DB::statement('ALTER TABLE mt_karyawan ALTER COLUMN kecamatan VARCHAR(100) NULL');
        DB::statement('ALTER TABLE mt_karyawan ALTER COLUMN kelurahan VARCHAR(100) NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverting back might fail if there are string values, so we just try our best
        DB::statement('ALTER TABLE mt_karyawan ALTER COLUMN kecamatan INT NULL');
        DB::statement('ALTER TABLE mt_karyawan ALTER COLUMN kelurahan INT NULL');
    }
};
