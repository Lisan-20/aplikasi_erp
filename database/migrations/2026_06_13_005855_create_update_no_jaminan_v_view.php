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
        DB::statement("CREATE OR ALTER VIEW dbo.update_no_jaminan_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_pasien.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.nik, 
                      dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.no_jaminan, dbo.tc_registrasi.status_batal
FROM         dbo.mt_master_pasien INNER JOIN
                      dbo.tc_registrasi ON dbo.mt_master_pasien.no_mr = dbo.tc_registrasi.no_mr AND dbo.mt_master_pasien.nik <> dbo.tc_registrasi.no_jaminan
WHERE     (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.mt_master_pasien.nik IS NOT NULL) AND (dbo.tc_registrasi.kode_perusahaan > 0)
ORDER BY dbo.tc_registrasi.kode_perusahaan DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_no_jaminan_v]");
    }
};
