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
        DB::statement("CREATE VIEW dbo.pm_pasienpm_radiologi_v
AS
SELECT     dbo.pm_pasienpm_bayar_v.no_mr, dbo.pm_pasienpm_bayar_v.kota, dbo.pm_pasienpm_bayar_v.nama_pasien, dbo.pm_pasienpm_bayar_v.tgl_lhr, dbo.pm_pasienpm_bayar_v.tlp_almt_ttp, 
                      dbo.pm_pasienpm_bayar_v.jen_kelamin, dbo.pm_pasienpm_bayar_v.status_batal, dbo.pm_pasienpm_bayar_v.stat_pasien, dbo.pm_pasienpm_bayar_v.no_kunjungan, 
                      dbo.pm_pasienpm_bayar_v.kode_bagian_tujuan, dbo.pm_pasienpm_bayar_v.kode_bagian_asal, dbo.pm_pasienpm_bayar_v.tgl_masuk, dbo.pm_pasienpm_bayar_v.tgl_keluar, 
                      dbo.pm_pasienpm_bayar_v.status_masuk, dbo.pm_pasienpm_bayar_v.status_keluar, dbo.pm_pasienpm_bayar_v.status_cito, dbo.pm_pasienpm_bayar_v.keterangan, 
                      dbo.pm_pasienpm_bayar_v.kode_penunjang, dbo.pm_pasienpm_bayar_v.tgl_daftar, dbo.pm_pasienpm_bayar_v.kode_bagian, dbo.pm_pasienpm_bayar_v.no_antrian, 
                      dbo.pm_pasienpm_bayar_v.tgl_isihasil, dbo.pm_pasienpm_bayar_v.no_foto, dbo.pm_pasienpm_bayar_v.dr_pengirim, dbo.pm_pasienpm_bayar_v.petugas_input, 
                      dbo.pm_pasienpm_bayar_v.status_daftar, dbo.pm_pasienpm_bayar_v.radiografer, dbo.pm_pasienpm_bayar_v.petugas_isihasil, dbo.pm_pasienpm_bayar_v.catatan_hasil, 
                      dbo.pm_pasienpm_bayar_v.status_isihasil, dbo.pm_pasienpm_bayar_v.no_induk, dbo.pm_pasienpm_bayar_v.kode_perusahaan, dbo.pm_pasienpm_bayar_v.no_registrasi, 
                      dbo.pm_pasienpm_bayar_v.kode_klas, dbo.pm_pasienpm_bayar_v.kode_kelompok, dbo.pm_pasienpm_bayar_v.no_hasil_pm, dbo.pm_pasienpm_bayar_v.status_bayar, 
                      dbo.pm_pasienpm_bayar_v.tahun, dbo.pm_pasienpm_bayar_v.status_man, dbo.tc_registrasi.umur, dbo.pm_pasienpm_bayar_v.noSep, dbo.tc_trans_pelayanan.kode_trans_pelayanan, 
                      dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_registrasi.kode_dokter, dbo.pm_tc_hasilpenunjang.kode_tc_hasilpenunjang, 
                      dbo.th_kirim_hasil_wa_terkirim_v.kode_trans_pelayanan AS kirim_wa, dbo.th_kirim_hasil_wa_terkirim_v.tgl_kirim, dbo.th_kirim_hasil_wa_terkirim_v.user_kirim, 
                      dbo.th_kirim_hasil_wa_terkirim_v.no_tlp
FROM         dbo.pm_pasienpm_bayar_v INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.pm_pasienpm_bayar_v.kode_penunjang = dbo.tc_trans_pelayanan.kode_penunjang INNER JOIN
                      dbo.pm_tc_hasilpenunjang ON dbo.tc_trans_pelayanan.kode_trans_pelayanan = dbo.pm_tc_hasilpenunjang.kode_trans_pelayanan INNER JOIN
                      dbo.tc_registrasi ON dbo.pm_pasienpm_bayar_v.no_registrasi = dbo.tc_registrasi.no_registrasi LEFT OUTER JOIN
                      dbo.th_kirim_hasil_wa_terkirim_v ON dbo.tc_trans_pelayanan.kode_trans_pelayanan = dbo.th_kirim_hasil_wa_terkirim_v.kode_trans_pelayanan
WHERE     (dbo.tc_trans_pelayanan.jenis_tindakan = 3) AND (dbo.pm_pasienpm_bayar_v.kode_bagian_tujuan = '050201')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_pasienpm_radiologi_v]");
    }
};
