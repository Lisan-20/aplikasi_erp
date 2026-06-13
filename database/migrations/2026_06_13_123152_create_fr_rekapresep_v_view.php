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
CREATE VIEW dbo.fr_rekapresep_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.tgl_transaksi AS tgl_trans, 
                      dbo.tc_trans_pelayanan.nama_tindakan AS nama_brg, dbo.mt_karyawan.no_induk, dbo.mt_karyawan.nama_pegawai, 
                      dbo.tc_trans_pelayanan.kode_barang AS kode_brg, dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.status_selesai AS status_transaksi, 
                      dbo.tc_trans_pelayanan.kode_dokter1 AS kode_dokter, dbo.mt_barang.kode_pabrik, dbo.tc_trans_pelayanan.status_kredit, 
                      dbo.tc_trans_pelayanan.kode_trans_far, dbo.tc_trans_pelayanan.kd_tr_resep, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.lain_lain, 
                      dbo.fr_tc_far.no_resep, dbo.tc_trans_pelayanan.no_mr, dbo.mt_master_pasien.nama_pasien
FROM         dbo.fr_tc_far INNER JOIN
                      dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_trans_pelayanan.kode_dokter1 = dbo.mt_karyawan.no_induk ON 
                      dbo.fr_tc_far.kode_trans_far = dbo.tc_trans_pelayanan.kode_trans_far INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_trans_pelayanan.no_mr = dbo.mt_master_pasien.no_mr LEFT OUTER JOIN
                      dbo.mt_barang ON dbo.tc_trans_pelayanan.kode_barang = dbo.mt_barang.kode_brg

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_rekapresep_v]");
    }
};
