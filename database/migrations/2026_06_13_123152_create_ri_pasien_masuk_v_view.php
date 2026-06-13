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
        DB::statement("CREATE OR ALTER VIEW dbo.ri_pasien_masuk_v
AS
SELECT     TOP (100) PERCENT dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.tgl_transaksi, 
                      dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.tgl_pindah, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.ri_tc_rawatinap.bag_pas, 
                      dbo.ri_tc_rawatinap.kelas_pas, DAY(dbo.ri_tc_rawatinap.tgl_masuk) AS tgl_masuk, MONTH(dbo.ri_tc_rawatinap.tgl_masuk) AS bln_masuk, YEAR(dbo.ri_tc_rawatinap.tgl_masuk) AS thn_masuk, 
                      DAY(dbo.ri_tc_rawatinap.tgl_keluar) AS tgl_keluar, MONTH(dbo.ri_tc_rawatinap.tgl_keluar) AS bln_keluar, YEAR(dbo.ri_tc_rawatinap.tgl_keluar) AS thn_keluar, 
                      dbo.tc_trans_pelayanan.status_selesai, dbo.ri_tc_rawatinap.status_pulang, dbo.ri_tc_riwayat_kelas.ket_masuk, dbo.ri_tc_riwayat_kelas.ket_pindah, dbo.ri_tc_riwayat_kelas.ket_keluar, 
                      dbo.tc_trans_pelayanan.kode_klas, dbo.ri_tc_riwayat_kelas.kode_kematian, dbo.ri_tc_riwayat_kelas.waktu_kematian, dbo.ri_tc_rawatinap.tgl_masuk AS tgl_masukan, 
                      dbo.ri_tc_rawatinap.tgl_keluar AS tgl_keluaran
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.tc_trans_pelayanan.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan INNER JOIN
                      dbo.ri_tc_riwayat_kelas ON dbo.ri_tc_rawatinap.kode_ri = dbo.ri_tc_riwayat_kelas.kode_ri AND dbo.tc_trans_pelayanan.kode_bagian = dbo.ri_tc_riwayat_kelas.bagian_tujuan AND 
                      dbo.tc_trans_pelayanan.kode_klas = dbo.ri_tc_riwayat_kelas.kelas_tujuan
WHERE     (dbo.tc_trans_pelayanan.jenis_tindakan = 1) AND (NOT (dbo.tc_trans_pelayanan.kode_bagian IN ('030501', '030601', '030901'))) AND (dbo.tc_trans_pelayanan.status_selesai >= 2)
ORDER BY dbo.tc_trans_pelayanan.no_kunjungan DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ri_pasien_masuk_v]");
    }
};
