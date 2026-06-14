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
        DB::statement("CREATE OR ALTER VIEW dbo.pindah_billing_umum_persh_pt_bpjs_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif.kode_bagian, dbo.mt_master_tarif_detail.kode_klas, 
                      dbo.mt_klas.nama_klas, dbo.mt_master_tarif_detail.bill_rs, dbo.tc_trans_pelayanan.bill_rs AS bill_rs_trans, dbo.mt_master_tarif_detail.bill_dr1, 
                      dbo.tc_trans_pelayanan.bill_dr1 AS bill_dr1_trans, dbo.mt_master_tarif_detail.bill_dr2, dbo.tc_trans_pelayanan.bill_dr2 AS bill_dr2_trans, 
                      dbo.mt_master_tarif_detail.total, dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, 
                      dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, 
                      dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.tc_trans_pelayanan.kode_bagian AS kode_bagian_trans, 
                      dbo.tc_trans_pelayanan.jumlah, dbo.mt_master_tarif.flag_rujukan, dbo.mt_master_tarif_detail.bill_rs_pt, dbo.mt_master_tarif_detail.bill_dr1_pt, 
                      dbo.mt_master_tarif_detail.bill_dr2_pt, dbo.mt_master_tarif_detail.bill_rs_ass, dbo.mt_master_tarif_detail.bill_dr1_ass, dbo.mt_master_tarif_detail.bill_dr2_ass, 
                      dbo.mt_master_tarif_detail.bill_rs_bpjs, dbo.mt_master_tarif_detail.bill_dr1_bpjs, dbo.mt_master_tarif_detail.bill_dr2_bpjs
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif INNER JOIN
                      dbo.mt_klas ON dbo.mt_master_tarif_detail.kode_klas = dbo.mt_klas.kode_klas INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.mt_master_tarif.kode_tarif = dbo.tc_trans_pelayanan.kode_tarif AND 
                      dbo.mt_klas.kode_klas = dbo.tc_trans_pelayanan.kode_klas
WHERE     (dbo.tc_trans_pelayanan.kode_tc_trans_kasir IS NULL) AND (dbo.tc_trans_pelayanan.kode_tarif NOT IN
                          (SELECT     kode_tarif
                            FROM          dbo.mt_master_tarif_detail_bedah)) AND (dbo.mt_master_tarif.flag_rujukan IS NULL OR
                      dbo.mt_master_tarif.flag_rujukan = 0)
ORDER BY dbo.mt_master_tarif.kode_bagian, dbo.mt_master_tarif_detail.kode_klas
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pindah_billing_umum_persh_pt_bpjs_v]");
    }
};
