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
        DB::statement("CREATE OR ALTER VIEW dbo.v_pindah_billing_pasien
AS
SELECT     TOP (100) PERCENT dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif.kode_bagian, dbo.mt_bagian.nama_bagian, 
                      dbo.mt_master_tarif_detail.kode_klas, dbo.mt_klas.nama_klas, dbo.mt_master_tarif_detail.bill_rs, dbo.mt_master_tarif_detail.bill_dr1, 
                      dbo.mt_master_tarif_detail.bill_dr2, dbo.mt_master_tarif_detail.total, dbo.tc_trans_pelayanan.bill_rs AS bill_rs_trans, 
                      dbo.tc_trans_pelayanan.bill_dr1 AS bill_dr1_trans, dbo.tc_trans_pelayanan.bill_dr2 AS bill_dr2_trans, 
                      dbo.tc_trans_pelayanan.bill_rs_jatah AS bill_rs_jatah_trans, dbo.tc_trans_pelayanan.bill_dr1_jatah AS bill_dr1_jatah_trans, 
                      dbo.tc_trans_pelayanan.bill_dr2_jatah AS bill_dr2_jatah_trans, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, 
                      dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, 
                      dbo.mt_master_tarif_detail.bill_rs AS bill_rs_mt, dbo.mt_master_tarif_detail.bill_dr1 AS bill_dr1_mt, dbo.mt_master_tarif_detail.bill_dr2 AS bill_dr2_mt, 
                      dbo.mt_master_tarif_detail.total AS total_mt, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_bagian_asal, 
                      dbo.tc_trans_pelayanan.kode_bagian AS kode_bagian_trans, dbo.mt_master_tarif_detail.bill_rs_pt, dbo.mt_master_tarif_detail.bill_dr1_pt, 
                      dbo.mt_master_tarif_detail.bill_dr2_pt, dbo.mt_master_tarif_detail.bill_rs_ass, dbo.mt_master_tarif_detail.bill_dr1_ass, 
                      dbo.mt_master_tarif_detail.bill_dr2_ass, dbo.mt_master_tarif_detail.bill_rs_bpjs, dbo.mt_master_tarif_detail.bill_dr1_bpjs, 
                      dbo.mt_master_tarif_detail.bill_dr2_bpjs, dbo.mt_master_tarif_detail.bill_rs_inhealth, dbo.mt_master_tarif_detail.bill_dr1_inhealth, 
                      dbo.mt_master_tarif_detail.bill_dr2_inhealth, dbo.tc_trans_pelayanan.jumlah
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif INNER JOIN
                      dbo.mt_klas ON dbo.mt_master_tarif_detail.kode_klas = dbo.mt_klas.kode_klas INNER JOIN
                      dbo.mt_bagian ON dbo.mt_master_tarif.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.mt_master_tarif.kode_tarif = dbo.tc_trans_pelayanan.kode_tarif AND 
                      dbo.mt_klas.kode_klas = dbo.tc_trans_pelayanan.kode_klas AND dbo.mt_master_tarif_detail.kode_klas = dbo.tc_trans_pelayanan.kode_klas
WHERE     (dbo.tc_trans_pelayanan.kode_tc_trans_kasir IS NULL) AND (dbo.tc_trans_pelayanan.kode_bagian <> '030901')
ORDER BY dbo.mt_master_tarif.kode_bagian, dbo.mt_master_tarif_detail.kode_klas
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_pindah_billing_pasien]");
    }
};
