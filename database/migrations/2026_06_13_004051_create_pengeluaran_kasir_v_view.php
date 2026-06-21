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
        DB::statement("CREATE OR ALTER VIEW dbo.pengeluaran_kasir_v
AS
SELECT        TOP (100) PERCENT c.id_bd_tc_trans_det, c.id_bd_tc_trans, c.kd_group_trans, c.kd_trans_bendahara, c.id_bank, c.giro, c.no_bukti, c.no_ref, c.tgl_transaksi, c.penerima, c.uraian, c.materai, c.jumlah, c.no_induk, a.flag_modul, 
                         a.flag_tmp, c.flag_jurnal, c.tgl_ver, c.kode_bagian, c.kode_suplier, c.kode_perusahaan, c.kode_dr, c.acc_no, c.tx_tipe, c.no_urut, c.status, c.flag_kecil, a.detail, c.id_bd_tc_trans_det AS id_bd_tc_trans1, 
                         c.kode_perusahaan AS kode_perusahaan1, c.kode_dr AS kode_dr1, YEAR(a.tgl_transaksi) AS tahun, MONTH(a.tgl_transaksi) AS bulan, DAY(a.tgl_transaksi) AS tanggal, 
                         dbo.mt_karyawan.kode_bagian AS kode_bagian_kasir
FROM            dbo.bd_tc_trans AS a INNER JOIN
                         dbo.bd_tc_trans_detail AS c ON a.id_bd_tc_trans = c.id_bd_tc_trans INNER JOIN
                         dbo.mt_karyawan ON a.no_induk = dbo.mt_karyawan.no_induk
WHERE        (a.kode_bagian = 110601) AND (c.penerima NOT IN ('eti')) AND (c.penerima IS NOT NULL)
GROUP BY c.id_bd_tc_trans_det, c.id_bd_tc_trans, c.kd_group_trans, c.kd_trans_bendahara, c.id_bank, c.giro, c.no_bukti, c.no_ref, c.tgl_transaksi, c.penerima, c.uraian, c.materai, c.jumlah, c.no_induk, a.flag_modul, a.flag_tmp, 
                         c.flag_jurnal, c.tgl_ver, c.kode_bagian, c.kode_suplier, c.kode_perusahaan, c.kode_dr, c.acc_no, c.tx_tipe, c.no_urut, c.status, c.flag_kecil, a.detail, YEAR(a.tgl_transaksi), MONTH(a.tgl_transaksi), DAY(a.tgl_transaksi), 
                         dbo.mt_karyawan.kode_bagian
HAVING        (c.jumlah IS NOT NULL) AND (c.tx_tipe = 1) AND (c.flag_kecil IS NULL) AND (dbo.mt_karyawan.kode_bagian = '210304')
ORDER BY c.tgl_transaksi DESC, c.id_bd_tc_trans DESC, c.no_urut
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pengeluaran_kasir_v]");
    }
};
