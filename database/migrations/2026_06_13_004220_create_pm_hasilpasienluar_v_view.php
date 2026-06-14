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
        DB::statement("CREATE OR ALTER VIEW dbo.pm_hasilpasienluar_v
AS
SELECT     dbo.pm_tc_hasilpenunjang.*, dbo.pm_mt_standarhasil.standar_hasil_wanita AS standar_hasil_wanita, 
                      dbo.pm_mt_standarhasil.standar_hasil_pria AS standar_hasil_pria, dbo.pm_mt_standarhasil.nama_pemeriksaan AS nama_pemeriksaan, 
                      dbo.pm_mt_standarhasil.satuan AS satuan, dbo.pm_mt_standarhasil.kode_tarif AS kode_tarif, 
                      dbo.pm_pemeriksaanpasienluar_v.status_daftar AS status_daftar, dbo.pm_pemeriksaanpasienluar_v.jen_kelamin AS jen_kelamin, 
                      dbo.pm_pemeriksaanpasienluar_v.catatan_hasil AS catatan_hasil, dbo.pm_pemeriksaanpasienluar_v.kode_tc_trans_kasir AS kode_tc_trans_kasir, 
                      dbo.pm_pemeriksaanpasienluar_v.no_kunjungan AS no_kunjungan, dbo.pm_pemeriksaanpasienluar_v.no_registrasi AS no_registrasi, 
                      dbo.pm_pemeriksaanpasienluar_v.no_mr AS no_mr, dbo.pm_pemeriksaanpasienluar_v.kode_kelompok AS kode_kelompok, 
                      dbo.pm_pemeriksaanpasienluar_v.kode_perusahaan AS kode_perusahaan, dbo.pm_pemeriksaanpasienluar_v.tgl_transaksi AS tgl_transaksi, 
                      dbo.pm_pemeriksaanpasienluar_v.nama_tindakan AS nama_tindakan, dbo.pm_pemeriksaanpasienluar_v.kode_bagian AS kode_bagian, 
                      dbo.pm_pemeriksaanpasienluar_v.kode_penunjang AS kode_penunjang, dbo.pm_pemeriksaanpasienluar_v.status_selesai AS status_selesai, 
                      dbo.pm_pemeriksaanpasienluar_v.status_isihasil AS status_isihasil, dbo.pm_pemeriksaanpasienluar_v.no_hasil_pm AS no_hasil_pm, 
                      dbo.pm_pemeriksaanpasienluar_v.petugas_isihasil AS petugas_isihasil, dbo.pm_mt_standarhasil.urutan AS urutan
FROM         dbo.pm_tc_hasilpenunjang INNER JOIN
                      dbo.pm_mt_standarhasil ON dbo.pm_tc_hasilpenunjang.kode_mt_hasilpm = dbo.pm_mt_standarhasil.kode_mt_hasilpm INNER JOIN
                      dbo.pm_pemeriksaanpasienluar_v ON dbo.pm_tc_hasilpenunjang.kode_trans_pelayanan = dbo.pm_pemeriksaanpasienluar_v.kode_trans_pelayanan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_hasilpasienluar_v]");
    }
};
