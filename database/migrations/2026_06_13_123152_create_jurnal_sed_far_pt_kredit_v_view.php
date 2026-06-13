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
        DB::statement("CREATE VIEW dbo.jurnal_sed_far_pt_kredit_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.jenis_tindakan, 
                      SUM(dbo.tc_trans_pelayanan.bill_rs) AS bill_rs, SUM(dbo.tc_trans_pelayanan.bill_dr1) AS bill_dr1, dbo.tc_trans_pelayanan.kode_dokter1, 
                      dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.tc_trans_kasir.seri_kuitansi, SUM(dbo.tc_trans_pelayanan.lain_lain) 
                      AS lain_lain, dbo.tc_trans_pelayanan.kode_barang, dbo.mapping_transaksi_rs_v.acc_debet, dbo.mapping_transaksi_rs_v.acc_kredit, 
                      dbo.mapping_transaksi_rs_v.nama_debet, dbo.mapping_transaksi_rs_v.nama_kredit, dbo.mapping_transaksi_rs_v.nama_bagian, dbo.tc_trans_kasir.no_kuitansi, 
                      dbo.tc_trans_kasir.tgl_jam, dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_pelayanan.jumlah, 
                      dbo.tc_trans_pelayanan.nama_tindakan, dbo.mt_perusahaan.flag
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir INNER JOIN
                      dbo.mapping_transaksi_rs_v ON dbo.tc_trans_pelayanan.jenis_tindakan = dbo.mapping_transaksi_rs_v.kode AND 
                      dbo.tc_trans_pelayanan.kode_bagian = dbo.mapping_transaksi_rs_v.kode_bagian INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_perusahaan ON dbo.tc_registrasi.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan
WHERE     (dbo.mapping_transaksi_rs_v.kode_proses = 2) AND (dbo.tc_trans_kasir.seri_kuitansi = 'AJ') AND (dbo.tc_trans_pelayanan.kode_barang IS NOT NULL) AND 
                      (dbo.tc_trans_pelayanan.kode_kelompok = 3 OR
                      dbo.tc_trans_pelayanan.kode_kelompok = 5) AND (dbo.tc_trans_pelayanan.kode_perusahaan > 0) AND (dbo.mt_perusahaan.flag = 0 OR
                      dbo.mt_perusahaan.flag IS NULL) AND (dbo.tc_trans_pelayanan.flag_jurnal = 0) AND (dbo.tc_trans_kasir.status_batal IS NULL) AND 
                      (dbo.tc_trans_pelayanan.status_kredit = 1) AND (dbo.mapping_transaksi_rs_v.acc_debet > 0)
GROUP BY dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.jenis_tindakan, 
                      dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.tc_trans_kasir.seri_kuitansi, 
                      dbo.tc_trans_pelayanan.kode_barang, dbo.mapping_transaksi_rs_v.acc_debet, dbo.mapping_transaksi_rs_v.acc_kredit, dbo.mapping_transaksi_rs_v.nama_debet, 
                      dbo.mapping_transaksi_rs_v.nama_kredit, dbo.mapping_transaksi_rs_v.nama_bagian, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam, 
                      dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.nama_tindakan, 
                      dbo.mt_perusahaan.flag
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_sed_far_pt_kredit_v]");
    }
};
