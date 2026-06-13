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
        DB::statement("CREATE OR ALTER VIEW dbo.penyerahan_resep_rajal_v
AS
SELECT     dbo.fr_tc_far.kode_trans_far, dbo.fr_tc_far.kode_pesan_resep, dbo.fr_tc_far.kode_profit, dbo.fr_tc_far.kode_bagian, dbo.fr_tc_far.tgl_trans, dbo.fr_tc_far.kode_bagian_asal, dbo.fr_tc_far.no_mr, 
                      dbo.fr_tc_far.no_registrasi, dbo.fr_tc_far.no_kunjungan, dbo.fr_tc_far.kode_dokter, dbo.fr_tc_far.telpon_pasien, dbo.fr_tc_far.status_transaksi, dbo.fr_tc_far.flag_serah, 
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir, YEAR(dbo.fr_tc_far.tgl_trans) AS Expr1, dbo.mt_master_pasien.nama_pasien, dbo.fr_tc_far.nama_pasien AS nama_pasien1, 
                      dbo.mt_bagian.nama_bagian, dbo.fr_tc_far.flag_selesai, dbo.fr_tc_far.user_selesai, dbo.fr_tc_far.flag_resep, dbo.tc_trans_pelayanan.kode_kelompok, dbo.fr_tc_far.user_serah, 
                      dbo.fr_tc_far.penerima, dbo.tc_trans_pelayanan.no_registrasi AS Expr2
FROM         dbo.fr_tc_far INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.fr_tc_far.kode_trans_far = dbo.tc_trans_pelayanan.kode_trans_far INNER JOIN
                      dbo.mt_bagian ON dbo.fr_tc_far.kode_bagian_asal = dbo.mt_bagian.kode_bagian LEFT OUTER JOIN
                      dbo.mt_master_pasien ON dbo.fr_tc_far.no_mr = dbo.mt_master_pasien.no_mr
GROUP BY dbo.fr_tc_far.kode_trans_far, dbo.fr_tc_far.kode_pesan_resep, dbo.fr_tc_far.kode_profit, dbo.fr_tc_far.kode_bagian, dbo.fr_tc_far.tgl_trans, dbo.fr_tc_far.kode_bagian_asal, dbo.fr_tc_far.no_mr, 
                      dbo.fr_tc_far.no_registrasi, dbo.fr_tc_far.no_kunjungan, dbo.fr_tc_far.kode_dokter, dbo.fr_tc_far.telpon_pasien, dbo.fr_tc_far.status_transaksi, dbo.fr_tc_far.flag_serah, 
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir, YEAR(dbo.fr_tc_far.tgl_trans), dbo.mt_master_pasien.nama_pasien, dbo.fr_tc_far.nama_pasien, dbo.mt_bagian.nama_bagian, 
                      dbo.fr_tc_far.flag_selesai, dbo.fr_tc_far.user_selesai, dbo.fr_tc_far.flag_resep, dbo.tc_trans_pelayanan.kode_kelompok, dbo.fr_tc_far.user_serah, dbo.fr_tc_far.penerima, 
                      dbo.tc_trans_pelayanan.no_registrasi
HAVING      (YEAR(dbo.fr_tc_far.tgl_trans) >= 2023)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [penyerahan_resep_rajal_v]");
    }
};
