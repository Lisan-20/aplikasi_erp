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
        DB::statement("CREATE VIEW dbo.jurnal_administrasi_farmasi_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_kelompok, 
                      dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_bagian_asal,
                       dbo.tc_trans_kasir.seri_kuitansi, SUM(dbo.tc_trans_pelayanan.lain_lain) AS lain_lain, dbo.tc_trans_pelayanan.kode_barang, dbo.mapping_transaksi_rs_v.acc_debet, 
                      dbo.mapping_transaksi_rs_v.acc_kredit, dbo.mapping_transaksi_rs_v.nama_debet, dbo.mapping_transaksi_rs_v.nama_kredit, 
                      dbo.mapping_transaksi_rs_v.nama_bagian, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir INNER JOIN
                      dbo.mapping_transaksi_rs_v ON dbo.tc_trans_pelayanan.kode_bagian = dbo.mapping_transaksi_rs_v.kode_bagian
WHERE     (dbo.mapping_transaksi_rs_v.kode_proses = 2) AND (dbo.tc_trans_kasir.seri_kuitansi = 'RJ' OR
                      dbo.tc_trans_kasir.seri_kuitansi = 'AJ') AND (dbo.tc_trans_pelayanan.lain_lain > 0) AND (dbo.tc_trans_pelayanan.kode_bagian = '060101') AND 
                      (dbo.mapping_transaksi_rs_v.kode_jenis_proses = 9) AND (dbo.tc_trans_pelayanan.status_kredit = 0 OR
                      dbo.tc_trans_pelayanan.status_kredit IS NULL) AND (dbo.mapping_transaksi_rs_v.acc_kredit > 0)
GROUP BY dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_kelompok, 
                      dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_bagian_asal,
                       dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_pelayanan.kode_barang, dbo.mapping_transaksi_rs_v.acc_debet, dbo.mapping_transaksi_rs_v.acc_kredit, 
                      dbo.mapping_transaksi_rs_v.nama_debet, dbo.mapping_transaksi_rs_v.nama_kredit, dbo.mapping_transaksi_rs_v.nama_bagian, dbo.tc_trans_kasir.no_kuitansi, 
                      dbo.tc_trans_kasir.tgl_jam
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_administrasi_farmasi_v]");
    }
};
