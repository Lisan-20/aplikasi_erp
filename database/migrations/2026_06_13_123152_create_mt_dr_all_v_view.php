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
        DB::statement("CREATE VIEW dbo.mt_dr_all_v
AS
SELECT     nama_pegawai, kode_bagian, kode_dokter, flag_aktif
FROM         dbo.mt_karyawan
WHERE     (flag_aktif <> 1) AND (kode_dokter IS NOT NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_dr_all_v]");
    }
};
