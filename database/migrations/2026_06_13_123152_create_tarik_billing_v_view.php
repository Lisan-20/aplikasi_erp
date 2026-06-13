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
        DB::statement("CREATE VIEW dbo.tarik_billing_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_kunjungan, 
                      dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.nama_pasien_layan, 
                      dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.tgl_transaksi, 
                      dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, 
                      dbo.tc_trans_pelayanan.bill_rs_jatah, dbo.tc_trans_pelayanan.bill_dr1_jatah, dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.mt_master_tarif_detail.bill_rs AS bill_rs_mt, dbo.mt_master_tarif_detail.bill_dr1 AS bill_dr1_mt, dbo.mt_master_tarif_detail.bill_rs_pt, 
                      dbo.mt_master_tarif_detail.bill_dr1_pt, dbo.mt_master_tarif_detail.bill_rs_ass, dbo.mt_master_tarif_detail.bill_dr1_ass, 
                      dbo.mt_master_tarif_detail.bill_rs_bpjs, dbo.mt_master_tarif_detail.bill_dr1_bpjs
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif AND 
                      dbo.tc_trans_pelayanan.kode_klas = dbo.mt_master_tarif_detail.kode_klas
WHERE     (dbo.tc_trans_pelayanan.kode_tarif NOT IN
                          (SELECT     kode_tarif
                            FROM          dbo.mt_master_tarif_detail_bedah))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tarik_billing_v]");
    }
};
