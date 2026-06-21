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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_kontrak_perusahaan_v
AS
SELECT     dbo.mt_perusahaan.kode_perusahaan, dbo.mt_perusahaan.nama_perusahaan, dbo.mt_kontrak_perusahaan.id_mt_kontrak_perusahaan, 
                      dbo.mt_kontrak_perusahaan.no_kontrak, dbo.mt_kontrak_perusahaan.tgl_awal, dbo.mt_kontrak_perusahaan.tgl_akhir, dbo.mt_kontrak_perusahaan.pejabat, 
                      dbo.mt_kontrak_perusahaan.id_pejabat, dbo.mt_kontrak_perusahaan.wakil_perusahaan, dbo.mt_karyawan.nama_pegawai AS marketing, 
                      dbo.mt_kontrak_perusahaan.marketing AS kode_marketing, dbo.mt_kontrak_perusahaan.status
FROM         dbo.mt_perusahaan INNER JOIN
                      dbo.mt_kontrak_perusahaan ON dbo.mt_perusahaan.kode_perusahaan = dbo.mt_kontrak_perusahaan.kode_perusahaan LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.mt_kontrak_perusahaan.marketing = dbo.mt_karyawan.no_induk
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_kontrak_perusahaan_v]");
    }
};
