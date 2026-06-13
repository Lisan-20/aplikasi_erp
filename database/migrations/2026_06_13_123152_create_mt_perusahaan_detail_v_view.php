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
        DB::statement("CREATE VIEW dbo.mt_perusahaan_detail_v
AS
SELECT     dbo.mt_perusahaan.kode_perusahaan, dbo.mt_perusahaan.nama_perusahaan, dbo.mt_kontrak_perusahaan.id_mt_kontrak_perusahaan, 
                      dbo.mt_kontrak_perusahaan.no_kontrak, dbo.mt_kontrak_perusahaan.tgl_awal, dbo.mt_kontrak_perusahaan.tgl_akhir, dbo.mt_kontrak_perusahaan.pejabat, 
                      dbo.mt_kontrak_perusahaan.id_pejabat, dbo.mt_kontrak_perusahaan.wakil_perusahaan, dbo.mt_karyawan.nama_pegawai AS marketing, 
                      dbo.mt_kontrak_perusahaan.marketing AS kode_marketing, dbo.mt_kontrak_perusahaan.status, dbo.mt_kontrak_perusahaan_detail.rawat_inap, 
                      dbo.mt_kontrak_perusahaan_detail.rawat_jalan, dbo.mt_kontrak_perusahaan_detail.pembedahan, dbo.mt_kontrak_perusahaan_detail.lab, 
                      dbo.mt_kontrak_perusahaan_detail.Radiologi, dbo.mt_kontrak_perusahaan_detail.obat, dbo.mt_kontrak_perusahaan_detail.penunjang_medis_lain, 
                      dbo.mt_kontrak_perusahaan_detail.diskon, dbo.mt_kontrak_perusahaan_detail.id_mt_perusahaan_detail
FROM         dbo.mt_perusahaan INNER JOIN
                      dbo.mt_kontrak_perusahaan ON dbo.mt_perusahaan.kode_perusahaan = dbo.mt_kontrak_perusahaan.kode_perusahaan INNER JOIN
                      dbo.mt_kontrak_perusahaan_detail ON dbo.mt_kontrak_perusahaan.no_kontrak = dbo.mt_kontrak_perusahaan_detail.no_kontrak AND 
                      dbo.mt_kontrak_perusahaan.kode_perusahaan = dbo.mt_kontrak_perusahaan_detail.kode_perusahaan LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.mt_kontrak_perusahaan.marketing = dbo.mt_karyawan.no_induk
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_perusahaan_detail_v]");
    }
};
