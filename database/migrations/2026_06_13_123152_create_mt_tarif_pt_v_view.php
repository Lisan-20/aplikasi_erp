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
        DB::statement("CREATE VIEW dbo.mt_tarif_pt_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif_detail_pt.kode_klas, dbo.mt_klas.nama_klas, 
                      dbo.mt_master_tarif_detail_pt.bill_rs, dbo.mt_master_tarif_detail_pt.bill_dr1, dbo.mt_master_tarif_detail_pt.bill_dr2, dbo.mt_master_tarif_detail_pt.total, 
                      dbo.mt_master_tarif.kode_bagian, dbo.mt_master_tarif.tingkatan, dbo.mt_tgl_tarif.kode_tgl_tarif, dbo.mt_tgl_tarif.status, 
                      dbo.mt_master_tarif_detail_pt.kode_master_tarif_detail, dbo.mt_master_tarif.jenis_tindakan, dbo.mt_master_tarif_detail_pt.alkes, dbo.mt_master_tarif_detail_pt.bhp, 
                      dbo.mt_master_tarif_detail_pt.pendapatan_rs, dbo.mt_master_tarif_detail_pt.paramedis, dbo.mt_master_tarif.kode_tindakan, 
                      dbo.mt_master_tarif_detail_pt.bill_rs_spesialis, dbo.mt_master_tarif_detail_pt.bill_dr1_spesialis, dbo.mt_master_tarif_detail_pt.bill_dr2_spesialis, 
                      dbo.mt_master_tarif_detail_pt.pendapatan_rs_spesialis, dbo.mt_master_tarif_detail_pt.total_spesialis, dbo.mt_master_tarif_detail_pt.bill_rs_rujukan, 
                      dbo.mt_master_tarif_detail_pt.sewa_alat, dbo.mt_master_tarif_detail_pt.kamar_tindakan, dbo.mt_master_tarif_detail_pt.bill_dr3
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail_pt ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail_pt.kode_tarif INNER JOIN
                      dbo.mt_klas ON dbo.mt_master_tarif_detail_pt.kode_klas = dbo.mt_klas.kode_klas LEFT OUTER JOIN
                      dbo.mt_tgl_tarif ON dbo.mt_master_tarif_detail_pt.kode_tgl_tarif = dbo.mt_tgl_tarif.kode_tgl_tarif
WHERE     (dbo.mt_tgl_tarif.status = 1) AND (dbo.mt_master_tarif.tingkatan = 5)
ORDER BY dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif_detail_pt.kode_klas
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_tarif_pt_v]");
    }
};
