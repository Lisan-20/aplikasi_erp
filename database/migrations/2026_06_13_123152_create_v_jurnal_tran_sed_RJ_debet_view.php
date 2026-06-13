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
        DB::statement("CREATE VIEW dbo.v_jurnal_tran_sed_RJ_debet
AS
SELECT     dbo.tran_sed.no_registrasi, dbo.tran_sed.no_mr, dbo.tran_sed.kode, dbo.tran_sed.kode_tc_trans_kasir, dbo.tran_sed.kode_barang, dbo.tran_sed.tgl_jam, 
                      dbo.tran_sed.kode_dr, dbo.tran_sed.kode_bagian, dbo.tran_sed.kode_kelompok, dbo.tran_sed.kode_perusahaan, dbo.mapping_transaksi_rs_v.acc_debet AS acc_no, 
                      dbo.mapping_transaksi_rs_v.nama_kredit, dbo.tran_sed.no_kuitansi, dbo.tran_sed.seri_kuitansi, dbo.mapping_transaksi_rs_v.nama_bagian, 
                      SUM(dbo.tran_sed.tx_nominal) AS tx_nominal, dbo.tran_sed.jumlah, dbo.tran_sed.flag_jurnal
FROM         dbo.tran_sed INNER JOIN
                      dbo.mapping_transaksi_rs_v ON dbo.tran_sed.kode_bagian = dbo.mapping_transaksi_rs_v.kode_bagian AND 
                      dbo.tran_sed.kode = dbo.mapping_transaksi_rs_v.kode
WHERE     (dbo.mapping_transaksi_rs_v.kode_proses = 2) AND (dbo.mapping_transaksi_rs_v.acc_debet > 0)
GROUP BY dbo.tran_sed.no_registrasi, dbo.tran_sed.no_mr, dbo.tran_sed.kode, dbo.tran_sed.kode_tc_trans_kasir, dbo.tran_sed.kode_barang, dbo.tran_sed.tgl_jam, 
                      dbo.tran_sed.kode_dr, dbo.tran_sed.kode_bagian, dbo.tran_sed.kode_kelompok, dbo.tran_sed.kode_perusahaan, dbo.mapping_transaksi_rs_v.acc_debet, 
                      dbo.mapping_transaksi_rs_v.nama_kredit, dbo.tran_sed.no_kuitansi, dbo.tran_sed.seri_kuitansi, dbo.mapping_transaksi_rs_v.nama_bagian, dbo.tran_sed.jumlah, 
                      dbo.tran_sed.flag_jurnal
HAVING      (dbo.tran_sed.flag_jurnal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_jurnal_tran_sed_RJ_debet]");
    }
};
