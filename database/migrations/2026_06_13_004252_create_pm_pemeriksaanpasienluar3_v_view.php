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
        DB::statement("CREATE OR ALTER VIEW dbo.pm_pemeriksaanpasienluar3_v
AS
SELECT     dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif.tingkatan, dbo.mt_master_tarif.referensi, mt_master_tarif_1.nama_tarif AS kategori, dbo.pm_pemeriksaanpasienluar_v.kode_trans_pelayanan, 
                      dbo.pm_pemeriksaanpasienluar_v.kode_tc_trans_kasir, dbo.pm_pemeriksaanpasienluar_v.no_kunjungan, dbo.pm_pemeriksaanpasienluar_v.no_registrasi, 
                      dbo.pm_pemeriksaanpasienluar_v.no_mr, dbo.pm_pemeriksaanpasienluar_v.nama_pasien_layan, dbo.pm_pemeriksaanpasienluar_v.kode_kelompok, 
                      dbo.pm_pemeriksaanpasienluar_v.kode_perusahaan, dbo.pm_pemeriksaanpasienluar_v.tgl_transaksi, dbo.pm_pemeriksaanpasienluar_v.jenis_tindakan, 
                      dbo.pm_pemeriksaanpasienluar_v.nama_tindakan, dbo.pm_pemeriksaanpasienluar_v.bill_rs, dbo.pm_pemeriksaanpasienluar_v.bill_dr1, dbo.pm_pemeriksaanpasienluar_v.bill_dr2, 
                      dbo.pm_pemeriksaanpasienluar_v.bill_rs_askes, dbo.pm_pemeriksaanpasienluar_v.bill_dr1_askes, dbo.pm_pemeriksaanpasienluar_v.bill_dr2_askes, 
                      dbo.pm_pemeriksaanpasienluar_v.bill_rs_jatah, dbo.pm_pemeriksaanpasienluar_v.bill_dr1_jatah, dbo.pm_pemeriksaanpasienluar_v.bill_dr2_jatah, dbo.pm_pemeriksaanpasienluar_v.lain_lain, 
                      dbo.pm_pemeriksaanpasienluar_v.kode_dokter1, dbo.pm_pemeriksaanpasienluar_v.kode_dokter2, dbo.pm_pemeriksaanpasienluar_v.jumlah, dbo.pm_pemeriksaanpasienluar_v.kode_barang, 
                      dbo.pm_pemeriksaanpasienluar_v.kode_master_tarif_detail, dbo.pm_pemeriksaanpasienluar_v.kode_master_tarif_detail_jatah, dbo.pm_pemeriksaanpasienluar_v.kode_tarif, 
                      dbo.pm_pemeriksaanpasienluar_v.kode_bagian, dbo.pm_pemeriksaanpasienluar_v.kode_bagian_asal, dbo.pm_pemeriksaanpasienluar_v.kode_penunjang, 
                      dbo.pm_pemeriksaanpasienluar_v.status_selesai, dbo.pm_pemeriksaanpasienluar_v.status_nk, dbo.pm_pemeriksaanpasienluar_v.nama_pasien, dbo.pm_pemeriksaanpasienluar_v.jen_kelamin, 
                      dbo.pm_pemeriksaanpasienluar_v.status_daftar, dbo.pm_pemeriksaanpasienluar_v.catatan_hasil, dbo.pm_pemeriksaanpasienluar_v.no_hasil_pm, 
                      dbo.pm_pemeriksaanpasienluar_v.status_isihasil, dbo.pm_pemeriksaanpasienluar_v.petugas_isihasil, dbo.pm_pemeriksaanpasienluar_v.Expr1, dbo.pm_pemeriksaanpasienluar_v.kode_klas, 
                      dbo.pm_pemeriksaanpasienluar_v.tgl_masuk, dbo.pm_pemeriksaanpasienluar_v.thn, dbo.pm_pemeriksaanpasienluar_v.bln, dbo.pm_pemeriksaanpasienluar_v.tgl, 
                      dbo.pm_pemeriksaanpasienluar_v.tgl_keluar, dbo.pm_pemeriksaanpasienluar_v.status_batal, dbo.pm_pemeriksaanpasienluar_v.kode_paramedis, dbo.pm_pemeriksaanpasienluar_v.flag_listrik, 
                      dbo.pm_pemeriksaanpasienluar_v.Expr2, dbo.pm_pemeriksaanpasienluar_v.dokter_pengirim AS dr_pengirim
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif AS mt_master_tarif_1 ON dbo.mt_master_tarif.referensi = mt_master_tarif_1.kode_tarif INNER JOIN
                      dbo.pm_pemeriksaanpasienluar_v ON dbo.mt_master_tarif.kode_tarif = dbo.pm_pemeriksaanpasienluar_v.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_pemeriksaanpasienluar3_v]");
    }
};
