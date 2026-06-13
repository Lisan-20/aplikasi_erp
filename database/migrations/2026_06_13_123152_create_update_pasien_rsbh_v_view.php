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
        DB::statement("CREATE VIEW dbo.update_pasien_rsbh_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_pasien.kode_kelompok, dbo.mt_master_pasien.kode_perusahaan, dbo.mt_perusahaan.nama_perusahaan
FROM         dbo.master_pasien_rsbh INNER JOIN
                      dbo.mt_master_pasien ON dbo.master_pasien_rsbh.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.mt_perusahaan ON dbo.mt_master_pasien.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan
WHERE     (dbo.mt_perusahaan.nama_perusahaan LIKE '%ASS%')
ORDER BY dbo.mt_perusahaan.nama_perusahaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_pasien_rsbh_v]");
    }
};
