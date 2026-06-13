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
        DB::statement("CREATE VIEW dbo.jurnal_tran_sed_diskon_RI_v
AS
SELECT     dbo.tran_sed.no_registrasi, dbo.tran_sed.no_mr, dbo.tran_sed.kode, dbo.tran_sed.kode_tc_trans_kasir, dbo.tran_sed.kode_barang, dbo.tran_sed.tgl_jam, 
                      dbo.tran_sed.kode_dr, dbo.tran_sed.kode_bagian, dbo.tran_sed.kode_kelompok, dbo.tran_sed.kode_perusahaan, dbo.mapping_transaksi_rs_v.acc_debet AS acc_no, 
                      dbo.tran_sed.no_kuitansi, dbo.tran_sed.seri_kuitansi, dbo.mapping_transaksi_rs_v.nama_bagian, SUM(dbo.tran_sed.tx_nominal) AS tx_nominal, 
                      SUM(dbo.tran_sed.jumlah) AS jumlah, dbo.tran_sed.flag_jurnal, dbo.tran_sed.kode_bagian_asal, dbo.mapping_transaksi_rs_v.nama_debet, 
                      dbo.tran_sed.kode_inap
FROM         dbo.tran_sed INNER JOIN
                      dbo.mapping_transaksi_rs_v ON dbo.tran_sed.kode = dbo.mapping_transaksi_rs_v.kode AND 
                      dbo.tran_sed.kode_bagian = dbo.mapping_transaksi_rs_v.kode_bagian
WHERE     (dbo.mapping_transaksi_rs_v.kode_proses = 2) AND (dbo.tran_sed.flag_jurnal IS NULL) AND (dbo.tran_sed.seri_kuitansi IN ('AI', 'RI')) AND 
                      (dbo.mapping_transaksi_rs_v.acc_debet > 0) AND (dbo.mapping_transaksi_rs_v.nama_jenis_proses LIKE 'diskon%')
GROUP BY dbo.tran_sed.no_registrasi, dbo.tran_sed.no_mr, dbo.tran_sed.kode, dbo.tran_sed.kode_tc_trans_kasir, dbo.tran_sed.kode_barang, dbo.tran_sed.tgl_jam, 
                      dbo.tran_sed.kode_dr, dbo.tran_sed.kode_bagian, dbo.tran_sed.kode_kelompok, dbo.tran_sed.kode_perusahaan, dbo.mapping_transaksi_rs_v.acc_debet, 
                      dbo.tran_sed.no_kuitansi, dbo.tran_sed.seri_kuitansi, dbo.mapping_transaksi_rs_v.nama_bagian, dbo.tran_sed.flag_jurnal, dbo.tran_sed.kode_bagian_asal, 
                      dbo.mapping_transaksi_rs_v.nama_debet, dbo.tran_sed.kode_inap
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_tran_sed_diskon_RI_v]");
    }
};
