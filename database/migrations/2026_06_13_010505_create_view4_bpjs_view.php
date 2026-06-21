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
        DB::statement("CREATE OR ALTER VIEW dbo.view4_bpjs
AS
SELECT     TOP (100) PERCENT dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif_detail.kode_master_tarif_detail, dbo.mt_master_tarif_detail.kode_klas, 
                      dbo.mt_master_tarif_detail.bill_rs, dbo.mt_master_tarif_detail.bill_dr1, dbo.mt_master_tarif_detail.bill_dr2, dbo.mt_master_tarif_detail.kode_tgl_tarif, 
                      dbo.mt_master_tarif_detail.kode_tarif, dbo.mt_master_tarif_detail.total, dbo.mt_master_tarif_detail.obat, dbo.mt_master_tarif_detail.alkes, 
                      dbo.mt_master_tarif_detail.adm, dbo.mt_master_tarif_detail.bhp, dbo.mt_master_tarif_detail.keterangan, dbo.mt_master_tarif_detail.bill_dr3, 
                      dbo.mt_master_tarif_detail.kamar_tindakan, dbo.mt_master_tarif_detail.paramedis, dbo.mt_master_tarif_detail.bill_rs_spesialis, 
                      dbo.mt_master_tarif_detail.bill_dr1_spesialis, dbo.mt_master_tarif_detail.bill_dr2_spesialis, dbo.mt_master_tarif_detail.pendapatan_rs, 
                      dbo.mt_master_tarif_detail.pendapatan_rs_spesialis, dbo.mt_master_tarif_detail.total_spesialis, dbo.mt_master_tarif_detail.bill_rs_rujukan, 
                      dbo.mt_master_tarif_detail.sewa_alat
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif
WHERE     (dbo.mt_master_tarif.kode_bagian LIKE '01%') AND (dbo.mt_master_tarif.kode_bagian NOT IN ('012201', '011801')) AND (dbo.mt_master_tarif.tingkatan = 5)
ORDER BY dbo.mt_master_tarif.kode_bagian, dbo.mt_master_tarif.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [view4_bpjs]");
    }
};
