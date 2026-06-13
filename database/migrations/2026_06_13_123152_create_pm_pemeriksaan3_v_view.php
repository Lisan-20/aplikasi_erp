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
        DB::statement("CREATE OR ALTER VIEW dbo.pm_pemeriksaan3_v
AS
SELECT     dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif.tingkatan, dbo.mt_master_tarif.referensi, mt_master_tarif_1.nama_tarif AS kategori, dbo.pm_pemeriksaanpasien_v.status_daftar, 
                      dbo.pm_pemeriksaanpasien_v.jen_kelamin, dbo.pm_pemeriksaanpasien_v.catatan_hasil, dbo.pm_pemeriksaanpasien_v.kode_trans_pelayanan, 
                      dbo.pm_pemeriksaanpasien_v.kode_tc_trans_kasir, dbo.pm_pemeriksaanpasien_v.no_kunjungan, dbo.pm_pemeriksaanpasien_v.no_registrasi, dbo.pm_pemeriksaanpasien_v.no_mr, 
                      dbo.pm_pemeriksaanpasien_v.kode_kelompok, dbo.pm_pemeriksaanpasien_v.kode_perusahaan, dbo.pm_pemeriksaanpasien_v.tgl_transaksi, dbo.pm_pemeriksaanpasien_v.jenis_tindakan, 
                      dbo.pm_pemeriksaanpasien_v.nama_tindakan, dbo.pm_pemeriksaanpasien_v.bill_rs, dbo.pm_pemeriksaanpasien_v.bill_dr1, dbo.pm_pemeriksaanpasien_v.bill_dr2, 
                      dbo.pm_pemeriksaanpasien_v.bill_rs_askes, dbo.pm_pemeriksaanpasien_v.bill_dr1_askes, dbo.pm_pemeriksaanpasien_v.bill_dr2_askes, dbo.pm_pemeriksaanpasien_v.bill_rs_jatah, 
                      dbo.pm_pemeriksaanpasien_v.bill_dr1_jatah, dbo.pm_pemeriksaanpasien_v.bill_dr2_jatah, dbo.pm_pemeriksaanpasien_v.lain_lain, dbo.pm_pemeriksaanpasien_v.kode_dokter1, 
                      dbo.pm_pemeriksaanpasien_v.kode_dokter2, dbo.pm_pemeriksaanpasien_v.jumlah, dbo.pm_pemeriksaanpasien_v.kode_barang, dbo.pm_pemeriksaanpasien_v.kode_master_tarif_detail, 
                      dbo.pm_pemeriksaanpasien_v.kode_master_tarif_detail_jatah, dbo.pm_pemeriksaanpasien_v.kode_tarif, dbo.pm_pemeriksaanpasien_v.kode_bagian, 
                      dbo.pm_pemeriksaanpasien_v.kode_bagian_asal, dbo.pm_pemeriksaanpasien_v.kode_penunjang, dbo.pm_pemeriksaanpasien_v.dr_pengirim, dbo.pm_pemeriksaanpasien_v.no_hasil_pm, 
                      dbo.pm_pemeriksaanpasien_v.petugas_isihasil, dbo.pm_pemeriksaanpasien_v.kode_klas, dbo.pm_pemeriksaanpasien_v.status_selesai, dbo.pm_pemeriksaanpasien_v.status_nk, 
                      dbo.pm_pemeriksaanpasien_v.nama_pasien, dbo.pm_pemeriksaanpasien_v.no_radio, dbo.pm_pemeriksaanpasien_v.waktu_sampel, dbo.pm_pemeriksaanpasien_v.tgl_isihasil
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif AS mt_master_tarif_1 ON dbo.mt_master_tarif.referensi = mt_master_tarif_1.kode_tarif INNER JOIN
                      dbo.pm_pemeriksaanpasien_v ON dbo.mt_master_tarif.kode_tarif = dbo.pm_pemeriksaanpasien_v.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_pemeriksaan3_v]");
    }
};
