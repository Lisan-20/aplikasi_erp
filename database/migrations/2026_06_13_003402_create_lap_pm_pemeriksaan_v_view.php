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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_pm_pemeriksaan_v
AS
SELECT        TOP (100) PERCENT dbo.pm_pasienpm_v.status_daftar, dbo.pm_pasienpm_v.jen_kelamin, dbo.pm_pasienpm_v.catatan_hasil, dbo.tc_trans_pelayanan.kode_trans_pelayanan, 
                         dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_kelompok, 
                         dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_rs, 
                         dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.bill_dr2, dbo.tc_trans_pelayanan.bill_rs_askes, dbo.tc_trans_pelayanan.bill_dr1_askes, dbo.tc_trans_pelayanan.bill_dr2_askes, 
                         dbo.tc_trans_pelayanan.bill_rs_jatah, dbo.tc_trans_pelayanan.bill_dr1_jatah, dbo.tc_trans_pelayanan.bill_dr2_jatah, dbo.tc_trans_pelayanan.lain_lain, dbo.tc_trans_pelayanan.kode_dokter1, 
                         dbo.tc_trans_pelayanan.kode_dokter2, dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.kode_barang, dbo.tc_trans_pelayanan.kode_master_tarif_detail, 
                         dbo.tc_trans_pelayanan.kode_master_tarif_detail_jatah, dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.status_selesai, dbo.tc_trans_pelayanan.status_nk, 
                         dbo.pm_pasienpm_v.dr_pengirim, dbo.pm_pasienpm_v.kode_penunjang, dbo.pm_pasienpm_v.no_hasil_pm, dbo.pm_pasienpm_v.petugas_isihasil, dbo.pm_pasienpm_v.kode_klas, 
                         dbo.pm_pasienpm_v.kode_bagian_asal, dbo.tc_trans_pelayanan.diskon_rs, dbo.tc_trans_pelayanan.diskon_dr1, dbo.tc_trans_pelayanan.diskon_dr2, dbo.pm_pasienpm_v.status_isihasil, 
                         YEAR(dbo.pm_pasienpm_v.tgl_masuk) AS thn, MONTH(dbo.pm_pasienpm_v.tgl_masuk) AS bln, DAY(dbo.pm_pasienpm_v.tgl_masuk) AS tgl, dbo.pm_pasienpm_v.tgl_masuk, dbo.pm_pasienpm_v.tgl_keluar, 
                         dbo.pm_pasienpm_v.status_batal, dbo.pm_pasienpm_v.nama_pasien, dbo.pm_pasienpm_v.kode_dr_pengirim, dbo.pm_pasienpm_v.no_radio, dbo.tc_trans_pelayanan.status_batal AS Expr1, 
                         dbo.tc_trans_pelayanan.kode_bagian_asal AS bagian_asal
FROM            dbo.pm_pasienpm_v INNER JOIN
                         dbo.tc_trans_pelayanan ON dbo.pm_pasienpm_v.kode_penunjang = dbo.tc_trans_pelayanan.kode_penunjang
GROUP BY dbo.pm_pasienpm_v.status_daftar, dbo.pm_pasienpm_v.jen_kelamin, dbo.pm_pasienpm_v.catatan_hasil, dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, 
                         dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_perusahaan, 
                         dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, 
                         dbo.tc_trans_pelayanan.bill_dr2, dbo.tc_trans_pelayanan.bill_rs_askes, dbo.tc_trans_pelayanan.bill_dr1_askes, dbo.tc_trans_pelayanan.bill_dr2_askes, dbo.tc_trans_pelayanan.bill_rs_jatah, 
                         dbo.tc_trans_pelayanan.bill_dr1_jatah, dbo.tc_trans_pelayanan.bill_dr2_jatah, dbo.tc_trans_pelayanan.lain_lain, dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.kode_dokter2, 
                         dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.kode_barang, dbo.tc_trans_pelayanan.kode_master_tarif_detail, dbo.tc_trans_pelayanan.kode_master_tarif_detail_jatah, 
                         dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.status_selesai, dbo.tc_trans_pelayanan.status_nk, dbo.pm_pasienpm_v.dr_pengirim, 
                         dbo.pm_pasienpm_v.kode_penunjang, dbo.pm_pasienpm_v.no_hasil_pm, dbo.pm_pasienpm_v.petugas_isihasil, dbo.pm_pasienpm_v.kode_klas, dbo.pm_pasienpm_v.kode_bagian_asal, 
                         dbo.tc_trans_pelayanan.diskon_rs, dbo.tc_trans_pelayanan.diskon_dr1, dbo.tc_trans_pelayanan.diskon_dr2, dbo.pm_pasienpm_v.status_isihasil, YEAR(dbo.pm_pasienpm_v.tgl_masuk), 
                         MONTH(dbo.pm_pasienpm_v.tgl_masuk), DAY(dbo.pm_pasienpm_v.tgl_masuk), dbo.pm_pasienpm_v.tgl_masuk, dbo.pm_pasienpm_v.tgl_keluar, dbo.pm_pasienpm_v.status_batal, 
                         dbo.pm_pasienpm_v.nama_pasien, dbo.pm_pasienpm_v.kode_dr_pengirim, dbo.pm_pasienpm_v.no_radio, dbo.tc_trans_pelayanan.status_batal, dbo.tc_trans_pelayanan.kode_bagian_asal
HAVING        (dbo.tc_trans_pelayanan.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.jenis_tindakan = 3)
ORDER BY dbo.tc_trans_pelayanan.tgl_transaksi DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_pm_pemeriksaan_v]");
    }
};
