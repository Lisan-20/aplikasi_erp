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
        DB::statement("CREATE OR ALTER VIEW dbo.rg_master_pasien3_v
AS
SELECT     dbo.mt_master_pasien.*, dbo.mt_nasabah.nama_kelompok AS nasabah, dbo.mt_perusahaan.nama_perusahaan AS perusahaan, 
                      dbo.mt_master_pasien.status_meninggal AS meninggal
FROM         dbo.mt_master_pasien INNER JOIN
                      dbo.mt_nasabah ON dbo.mt_master_pasien.kode_kelompok = dbo.mt_nasabah.kode_kelompok LEFT OUTER JOIN
                      dbo.mt_perusahaan ON dbo.mt_master_pasien.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan
WHERE     (dbo.mt_master_pasien.status_meninggal = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rg_master_pasien3_v]");
    }
};
