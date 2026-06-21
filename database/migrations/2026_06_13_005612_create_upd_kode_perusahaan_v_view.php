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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_kode_perusahaan_v
AS
SELECT     dbo.mt_master_pasien.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.kode_kelompok, dbo.mt_master_pasien.kode_perusahaan, 
                      dbo.Biodata.KdInstansi, dbo.Biodata.Instansi, dbo.mt_perusahaan.kode_perusahaan AS kode_perusahaan_up
FROM         dbo.Biodata INNER JOIN
                      dbo.mt_master_pasien ON dbo.Biodata.NamaPasien = dbo.mt_master_pasien.nama_pasien LEFT OUTER JOIN
                      dbo.mt_perusahaan ON dbo.Biodata.KdInstansi = dbo.mt_perusahaan.kode_p
WHERE     (dbo.mt_master_pasien.kode_kelompok = 3) AND (dbo.mt_master_pasien.kode_perusahaan IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_kode_perusahaan_v]");
    }
};
