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
        DB::statement("CREATE VIEW dbo.pm_pemeriksaanpasien_batal_v
AS
SELECT     TOP (100) PERCENT dbo.pm_pasien_pm_batal_v.status_daftar, dbo.pm_pasien_pm_batal_v.jen_kelamin, dbo.pm_pasien_pm_batal_v.catatan_hasil, 
                      dbo.pm_pasien_pm_batal_v.nama_pasien, dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, 
                      dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, 
                      dbo.tc_trans_pelayanan.nama_pasien_layan, dbo.pm_pasien_pm_batal_v.kode_kelompok, dbo.pm_pasien_pm_batal_v.kode_perusahaan, 
                      dbo.pm_pasien_pm_batal_v.tgl_masuk AS tgl_transaksi, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, 
                      dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.bill_dr2, dbo.tc_trans_pelayanan.bill_rs_askes, 
                      dbo.tc_trans_pelayanan.bill_dr1_askes, dbo.tc_trans_pelayanan.bill_dr2_askes, dbo.tc_trans_pelayanan.bill_rs_jatah, 
                      dbo.tc_trans_pelayanan.bill_dr1_jatah, dbo.tc_trans_pelayanan.bill_dr2_jatah, dbo.tc_trans_pelayanan.lain_lain, 
                      dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.kode_dokter2, dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.kode_barang, 
                      dbo.tc_trans_pelayanan.kode_master_tarif_detail, dbo.tc_trans_pelayanan.kode_master_tarif_detail_jatah, dbo.tc_trans_pelayanan.kode_tarif, 
                      dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.status_selesai, dbo.tc_trans_pelayanan.status_nk, 
                      dbo.pm_pasien_pm_batal_v.dr_pengirim, dbo.pm_pasien_pm_batal_v.kode_penunjang, dbo.pm_pasien_pm_batal_v.no_hasil_pm, 
                      dbo.pm_pasien_pm_batal_v.petugas_isihasil, dbo.pm_pasien_pm_batal_v.kode_klas, dbo.pm_pasien_pm_batal_v.kode_bagian_asal, 
                      dbo.tc_trans_pelayanan.diskon_rs, dbo.tc_trans_pelayanan.diskon_dr1, dbo.tc_trans_pelayanan.diskon_dr2, 
                      dbo.pm_pasien_pm_batal_v.status_isihasil, dbo.tc_trans_pelayanan.flag_tarik, dbo.tc_trans_pelayanan.status_batal, 
                      dbo.pm_pasien_pm_batal_v.tgl_masuk, YEAR(dbo.pm_pasien_pm_batal_v.tgl_masuk) AS thn, MONTH(dbo.pm_pasien_pm_batal_v.tgl_masuk) AS bln, 
                      DAY(dbo.pm_pasien_pm_batal_v.tgl_masuk) AS tgl, dbo.pm_pasien_pm_batal_v.tgl_keluar
FROM         dbo.pm_pasien_pm_batal_v INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.pm_pasien_pm_batal_v.kode_penunjang = dbo.tc_trans_pelayanan.kode_penunjang
ORDER BY tgl_transaksi DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_pemeriksaanpasien_batal_v]");
    }
};
