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
        DB::statement("CREATE VIEW dbo.mt_tarif_klas7_v
AS
SELECT     dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif_detail.kode_tarif, dbo.mt_master_tarif_detail.kode_klas, dbo.mt_master_tarif_detail.bill_rs, dbo.mt_master_tarif_detail.bill_dr1, 
                      dbo.mt_master_tarif_detail.bill_dr2, dbo.mt_master_tarif_detail.total, dbo.mt_master_tarif_detail.bill_rs_pt, dbo.mt_master_tarif_detail.bill_dr1_pt, dbo.mt_master_tarif_detail.bill_dr2_pt, 
                      dbo.mt_master_tarif_detail.total_pt, dbo.mt_master_tarif_detail.bill_rs_ass, dbo.mt_master_tarif_detail.bill_dr1_ass, dbo.mt_master_tarif_detail.bill_dr2_ass, dbo.mt_master_tarif_detail.total_ass, 
                      dbo.mt_master_tarif_detail.bill_rs_bpjs, dbo.mt_master_tarif_detail.bill_dr1_bpjs, dbo.mt_master_tarif_detail.bill_dr2_bpjs, dbo.mt_master_tarif_detail.total_bpjs, 
                      dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.bill_rs AS rs_up, dbo.tc_trans_pelayanan.bill_dr1 AS dr1_up, 
                      dbo.tc_trans_pelayanan.bill_dr2 AS dr2_up, dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, 
                      dbo.tc_trans_pelayanan.kode_klas AS kode_klas_layan
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif INNER JOIN
                      dbo.mt_klas ON dbo.mt_master_tarif_detail.kode_klas = dbo.mt_klas.kode_klas INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.mt_master_tarif.kode_tarif = dbo.tc_trans_pelayanan.kode_tarif
WHERE     (dbo.mt_master_tarif_detail.kode_klas = 7) AND (dbo.tc_trans_pelayanan.kode_tc_trans_kasir IS NULL OR
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_tarif_klas7_v]");
    }
};
