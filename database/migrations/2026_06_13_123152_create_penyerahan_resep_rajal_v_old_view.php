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
        DB::statement("CREATE VIEW dbo.penyerahan_resep_rajal_v
AS
SELECT        dbo.fr_tc_far.kode_trans_far, dbo.fr_tc_far.kode_pesan_resep, dbo.fr_tc_far.kode_profit, dbo.fr_tc_far.kode_bagian, dbo.fr_tc_far.tgl_trans, dbo.fr_tc_far.kode_bagian_asal, dbo.fr_tc_far.no_mr, 
                         dbo.fr_tc_far.no_registrasi, dbo.fr_tc_far.no_kunjungan, dbo.fr_tc_far.kode_dokter, dbo.fr_tc_far.telpon_pasien, dbo.fr_tc_far.status_transaksi, dbo.fr_tc_far.flag_serah, 
                         dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.status_batal, YEAR(dbo.fr_tc_far.tgl_trans) AS Expr1, 
                         dbo.mt_master_pasien.nama_pasien, dbo.fr_tc_far.nama_pasien AS nama_pasien1
FROM            dbo.fr_tc_far INNER JOIN
                         dbo.tc_trans_pelayanan ON dbo.fr_tc_far.kode_trans_far = dbo.tc_trans_pelayanan.kode_trans_far INNER JOIN
                         dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir LEFT OUTER JOIN
                         dbo.mt_master_pasien ON dbo.fr_tc_far.no_mr = dbo.mt_master_pasien.no_mr
GROUP BY dbo.fr_tc_far.kode_trans_far, dbo.fr_tc_far.kode_pesan_resep, dbo.fr_tc_far.kode_profit, dbo.fr_tc_far.kode_bagian, dbo.fr_tc_far.tgl_trans, dbo.fr_tc_far.kode_bagian_asal, dbo.fr_tc_far.no_mr, 
                         dbo.fr_tc_far.no_registrasi, dbo.fr_tc_far.no_kunjungan, dbo.fr_tc_far.kode_dokter, dbo.fr_tc_far.telpon_pasien, dbo.fr_tc_far.status_transaksi, dbo.fr_tc_far.flag_serah, 
                         dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.status_batal, YEAR(dbo.fr_tc_far.tgl_trans), 
                         dbo.mt_master_pasien.nama_pasien, dbo.fr_tc_far.nama_pasien
HAVING        (dbo.tc_trans_kasir.status_batal IS NULL) AND (YEAR(dbo.fr_tc_far.tgl_trans) >= 2015)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [penyerahan_resep_rajal_v_old]");
    }
};
