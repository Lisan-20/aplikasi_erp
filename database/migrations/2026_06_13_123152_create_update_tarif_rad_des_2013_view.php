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
        DB::statement("CREATE VIEW dbo.update_tarif_rad_des_2013
AS
SELECT     TOP (100) PERCENT dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif_detail_rev.bill_rs AS bill_rs_rev, 
                      dbo.mt_master_tarif_detail_rev.bill_dr1 AS bill_dr1_rev, dbo.mt_master_tarif_detail_rev.bill_dr2 AS bill_dr2_rev, dbo.mt_master_tarif_detail_rev.bhp AS bhp_rev, 
                      dbo.mt_master_tarif_detail_rev.pendapatan_rs AS pendapatan_rs_rev, dbo.mt_master_tarif_detail_rev.total AS total_rev, dbo.tc_trans_pelayanan.bill_rs, 
                      dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.bill_rs_jatah, dbo.tc_trans_pelayanan.bill_dr1_jatah, dbo.tc_trans_pelayanan.kode_kelompok, 
                      dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.kode_klas, dbo.tc_trans_pelayanan.no_registrasi, 
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.fee_dokter_rj_asuransi_temp.jumlah
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail_rev ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail_rev.kode_tarif INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.mt_master_tarif.kode_tarif = dbo.tc_trans_pelayanan.kode_tarif AND 
                      dbo.mt_master_tarif_detail_rev.kode_tarif = dbo.tc_trans_pelayanan.kode_tarif AND 
                      dbo.mt_master_tarif_detail_rev.kode_klas = dbo.tc_trans_pelayanan.kode_klas INNER JOIN
                      dbo.fee_dokter_rj_asuransi_temp ON dbo.tc_trans_pelayanan.kode_trans_pelayanan = dbo.fee_dokter_rj_asuransi_temp.kode_trans_pelayanan
WHERE     (MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) >= 11) AND (dbo.tc_trans_pelayanan.kode_kelompok = 3) AND (dbo.tc_trans_pelayanan.bill_dr1_jatah > 0)
ORDER BY dbo.tc_trans_pelayanan.tgl_transaksi DESC, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif_detail_rev.kode_klas DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_tarif_rad_des_2013]");
    }
};
