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
        // Because of SQL Server, sp_rename is more reliable for renaming columns than Schema::table renameColumn.
        DB::statement("EXEC sp_rename 'mt_karyawan.keluarahan', 'kelurahan', 'COLUMN'");
        DB::statement("EXEC sp_rename 'mt_karyawan.propinsi', 'provinsi', 'COLUMN'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("EXEC sp_rename 'mt_karyawan.kelurahan', 'keluarahan', 'COLUMN'");
        DB::statement("EXEC sp_rename 'mt_karyawan.provinsi', 'propinsi', 'COLUMN'");
    }
};
