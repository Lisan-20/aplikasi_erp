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
        DB::statement("CREATE VIEW dbo.upd_no_jaminan_pasien_v
AS
SELECT     TOP (100) PERCENT LTRIM(dbo.tc_registrasi.no_jaminan) AS Expr1, dbo.mt_master_pasien.no_askes, dbo.mt_master_pasien.nik, dbo.mt_master_pasien.no_mr, 
                      dbo.tc_registrasi.kode_kelompok
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr
WHERE     (NOT (dbo.tc_registrasi.kode_kelompok IN (1, 3, 5))) AND (dbo.mt_master_pasien.nik = '') AND (LTRIM(dbo.tc_registrasi.no_jaminan) <> '' AND LTRIM(dbo.tc_registrasi.no_jaminan) <> '-')
ORDER BY dbo.mt_master_pasien.no_mr
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_no_jaminan_pasien_v]");
    }
};
