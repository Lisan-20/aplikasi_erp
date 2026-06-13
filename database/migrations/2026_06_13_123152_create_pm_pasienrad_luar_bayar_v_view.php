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
        DB::statement("CREATE VIEW dbo.pm_pasienrad_luar_bayar_v
AS
SELECT     dbo.tc_trans_pelayanan_pm_v.status_selesai_bayar, dbo.pm_pasienluar_v.status_batal, dbo.pm_pasienluar_v.stat_pasien, dbo.pm_pasienluar_v.no_kunjungan, 
                      dbo.pm_pasienluar_v.kode_bagian_tujuan, dbo.pm_pasienluar_v.kode_bagian_asal, dbo.pm_pasienluar_v.tgl_masuk, dbo.pm_pasienluar_v.tgl_keluar, 
                      dbo.pm_pasienluar_v.status_masuk, dbo.pm_pasienluar_v.status_keluar, dbo.pm_pasienluar_v.status_cito, dbo.pm_pasienluar_v.keterangan, 
                      dbo.pm_pasienluar_v.kode_penunjang, dbo.pm_pasienluar_v.tgl_daftar, dbo.pm_pasienluar_v.kode_bagian, dbo.pm_pasienluar_v.no_antrian, 
                      dbo.pm_pasienluar_v.tgl_isihasil, dbo.pm_pasienluar_v.no_foto, dbo.pm_pasienluar_v.dr_pengirim, dbo.pm_pasienluar_v.petugas_input, 
                      dbo.pm_pasienluar_v.status_daftar, dbo.pm_pasienluar_v.radiografer, dbo.pm_pasienluar_v.petugas_isihasil, dbo.pm_pasienluar_v.catatan_hasil, 
                      dbo.pm_pasienluar_v.status_isihasil, dbo.pm_pasienluar_v.no_induk, dbo.pm_pasienluar_v.kode_perusahaan, dbo.pm_pasienluar_v.no_registrasi, 
                      dbo.pm_pasienluar_v.kode_klas, dbo.pm_pasienluar_v.nama_pasien, dbo.pm_pasienluar_v.no_mr, dbo.pm_pasienluar_v.jen_kelamin, 
                      dbo.pm_pasienluar_v.no_hasil_pm, dbo.pm_pasienluar_v.status_bayar, dbo.pm_pasienluar_v.kode_kelompok, YEAR(dbo.pm_pasienluar_v.tgl_daftar) AS tahun, 
                      dbo.pm_pasienluar_v.status_man
FROM         dbo.pm_pasienluar_v LEFT OUTER JOIN
                      dbo.tc_trans_pelayanan_pm_v ON dbo.pm_pasienluar_v.kode_penunjang = dbo.tc_trans_pelayanan_pm_v.kode_penunjang
WHERE     (dbo.pm_pasienluar_v.kode_bagian = '050201')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_pasienrad_luar_bayar_v]");
    }
};
