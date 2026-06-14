<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE OR ALTER VIEW dbo.SDM_karyawan_keluar_v
AS
SELECT     id_status, nama_pegawai, nama_bagian, npp
FROM         dbo.data_pokok_pegawai_v
WHERE     (id_status IN ('3', '4'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [SDM_karyawan_keluar_v]");
    }
};
