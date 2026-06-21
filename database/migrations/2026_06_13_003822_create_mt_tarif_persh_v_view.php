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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_tarif_persh_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif_detail_perusahaan.kode_klas, dbo.mt_klas.nama_klas, 
                      dbo.mt_master_tarif_detail_perusahaan.bill_rs, dbo.mt_master_tarif_detail_perusahaan.bill_dr1, dbo.mt_master_tarif_detail_perusahaan.bill_dr2, 
                      dbo.mt_master_tarif_detail_perusahaan.total, dbo.mt_master_tarif.kode_bagian, dbo.mt_master_tarif.tingkatan, dbo.mt_tgl_tarif.kode_tgl_tarif, dbo.mt_tgl_tarif.status, 
                      dbo.mt_master_tarif_detail_perusahaan.kode_master_tarif_detail, dbo.mt_master_tarif.jenis_tindakan, dbo.mt_master_tarif_detail_perusahaan.alkes, 
                      dbo.mt_master_tarif_detail_perusahaan.bhp, dbo.mt_master_tarif_detail_perusahaan.pendapatan_rs, dbo.mt_master_tarif_detail_perusahaan.paramedis, 
                      dbo.mt_master_tarif.kode_tindakan, dbo.mt_master_tarif.referensi
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail_perusahaan ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail_perusahaan.kode_tarif INNER JOIN
                      dbo.mt_klas ON dbo.mt_master_tarif_detail_perusahaan.kode_klas = dbo.mt_klas.kode_klas LEFT OUTER JOIN
                      dbo.mt_tgl_tarif ON dbo.mt_master_tarif_detail_perusahaan.kode_tgl_tarif = dbo.mt_tgl_tarif.kode_tgl_tarif
WHERE     (dbo.mt_tgl_tarif.status = 1) AND (dbo.mt_master_tarif.tingkatan = 5)
ORDER BY dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif_detail_perusahaan.kode_klas
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_tarif_persh_v]");
    }
};
