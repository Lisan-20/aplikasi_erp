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
        DB::statement("CREATE VIEW dbo.update_tarif_perusahaan_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif.tingkatan, dbo.mt_master_tarif.kode_bagian, 
                      dbo.mt_master_tarif_detail.kode_klas, dbo.mt_master_tarif_detail_perusahaan.bill_rs, dbo.mt_master_tarif_detail_perusahaan.bill_dr1, 
                      dbo.mt_master_tarif_detail_perusahaan.total, dbo.mt_master_tarif_detail_perusahaan.bhp, dbo.mt_master_tarif_detail_perusahaan.pendapatan_rs, 
                      dbo.mt_master_tarif_detail_perusahaan.bill_rs_rujukan, dbo.mt_master_tarif_detail.bill_rs AS bill_rs_up, dbo.mt_master_tarif_detail.bill_dr1 AS bill_dr1_up, 
                      dbo.mt_master_tarif_detail.total AS total_up, dbo.mt_master_tarif_detail.bhp AS bhp_up, dbo.mt_master_tarif_detail.pendapatan_rs AS pendapatan_rs_up, 
                      dbo.mt_master_tarif_detail.bill_rs_rujukan AS bill_rs_rujukan_up
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif LEFT OUTER JOIN
                      dbo.mt_master_tarif_detail_perusahaan ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail_perusahaan.kode_tarif AND 
                      dbo.mt_master_tarif_detail.kode_klas = dbo.mt_master_tarif_detail_perusahaan.kode_klas
WHERE     (dbo.mt_master_tarif.kode_bagian = '050101') AND (dbo.mt_master_tarif.tingkatan = 5)
ORDER BY dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif_detail.kode_klas
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_tarif_perusahaan_v]");
    }
};
