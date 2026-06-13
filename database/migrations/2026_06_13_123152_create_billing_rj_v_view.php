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
        DB::statement("CREATE VIEW dbo.billing_rj_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_kelompok, 
                      dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.jenis_tindakan, SUM(dbo.tc_trans_pelayanan.bill_rs) AS bill_rs, 
                      SUM(dbo.tc_trans_pelayanan.bill_dr1) AS bill_dr1, dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.tc_trans_kasir.seri_kuitansi, SUM(dbo.tc_trans_pelayanan.lain_lain) AS lain_lain, 
                      dbo.tc_trans_pelayanan.kode_barang, dbo.mapping_transaksi_rs_v.acc_debet, dbo.mapping_transaksi_rs_v.acc_kredit, dbo.mapping_transaksi_rs_v.nama_debet, 
                      dbo.mapping_transaksi_rs_v.nama_kredit, SUM(CASE WHEN dbo.tc_trans_pelayanan.bill_rs_jatah IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.bill_rs_jatah END) 
                      AS bill_rs_jatah, SUM(CASE WHEN dbo.tc_trans_pelayanan.bill_dr1_jatah IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.bill_dr1_jatah END) AS bill_dr1_jatah, 
                      SUM(CASE WHEN dbo.tc_trans_pelayanan.bill_dr2_jatah IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.bill_dr2_jatah END) AS bill_dr2_jatah
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir INNER JOIN
                      dbo.mapping_transaksi_rs_v ON dbo.tc_trans_pelayanan.jenis_tindakan = dbo.mapping_transaksi_rs_v.kode AND 
                      dbo.tc_trans_pelayanan.kode_bagian = dbo.mapping_transaksi_rs_v.kode_bagian
WHERE     (dbo.tc_trans_kasir.seri_kuitansi IN ('RJ', 'AJ')) AND (dbo.mapping_transaksi_rs_v.kode_proses = 2)
GROUP BY dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_kelompok, 
                      dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_pelayanan.kode_barang, dbo.mapping_transaksi_rs_v.acc_debet, 
                      dbo.mapping_transaksi_rs_v.acc_kredit, dbo.mapping_transaksi_rs_v.nama_debet, dbo.mapping_transaksi_rs_v.nama_kredit
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [billing_rj_v]");
    }
};
