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
        DB::statement("
CREATE OR ALTER VIEW dbo.fr_kinerjaresep_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.tgl_transaksi AS tgl_trans, 
                      dbo.tc_trans_pelayanan.nama_tindakan AS nama_brg, dbo.mt_karyawan.no_induk, dbo.mt_karyawan.nama_pegawai, 
                      dbo.tc_trans_pelayanan.kode_barang AS kode_brg, dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.status_selesai AS status_transaksi, 
                      dbo.mt_barang.kode_pabrik, dbo.tc_trans_pelayanan.status_kredit, dbo.tc_trans_pelayanan.kode_trans_far, dbo.tc_trans_pelayanan.kd_tr_resep, 
                      dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.lain_lain, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.jenis_tindakan, 
                      dbo.fr_tc_far.kode_dokter, dbo.fr_tc_far.no_resep, dbo.fr_tc_far.kode_profit
FROM         dbo.mt_karyawan RIGHT OUTER JOIN
                      dbo.tc_trans_pelayanan INNER JOIN
                      dbo.fr_tc_far ON dbo.tc_trans_pelayanan.kode_trans_far = dbo.fr_tc_far.kode_trans_far ON 
                      dbo.mt_karyawan.no_induk = dbo.tc_trans_pelayanan.kode_dokter1 LEFT OUTER JOIN
                      dbo.mt_barang ON dbo.tc_trans_pelayanan.kode_barang = dbo.mt_barang.kode_brg

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_kinerjaresep_v]");
    }
};
