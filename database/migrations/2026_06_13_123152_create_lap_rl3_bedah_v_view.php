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
        DB::statement("CREATE VIEW dbo.lap_rl3_bedah_v
AS
SELECT     dbo.tc_trans_kasir.no_mr, dbo.tc_trans_kasir.nama_pasien, dbo.tc_bedah.nama_tindakan, dbo.tc_bedah.kode_dr_bedah, dbo.tc_bedah.kode_dr_anestesi, dbo.tc_bedah.tgl_jam_masuk, 
                      dbo.tc_bedah.kode_perusahaan, dbo.tc_bedah.umur, dbo.tc_bedah.jenis_anestesi, dbo.th_riwayat_pasien.diagnosa_awal, dbo.mt_master_tarif.kode_bagian, 
                      dbo.mt_master_pasien.jen_kelamin AS jenis_kelamin, dbo.tc_bedah.kode_tarif, dbo.tc_bedah.kode_klas, dbo.tc_bedah.kode_kelompok, dbo.tc_trans_pelayanan.ref_bedah AS referensi, 
                      dbo.tc_trans_kasir.tgl_jam, dbo.tc_bedah.tgl_jam_keluar, COUNT(dbo.tc_bedah.nama_tindakan) AS Jumlah, YEAR(dbo.tc_trans_kasir.tgl_jam) AS thn
FROM         dbo.tc_bedah INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_bedah.id_bedah = dbo.tc_trans_pelayanan.id_bedah INNER JOIN
                      dbo.mt_master_tarif ON dbo.tc_bedah.kode_tarif = dbo.mt_master_tarif.kode_tarif INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_trans_kasir.no_registrasi INNER JOIN
                      dbo.th_riwayat_pasien ON dbo.tc_trans_pelayanan.no_registrasi = dbo.th_riwayat_pasien.no_registrasi INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_bedah.no_mr = dbo.mt_master_pasien.no_mr
GROUP BY dbo.tc_trans_kasir.no_mr, dbo.tc_trans_kasir.nama_pasien, dbo.tc_bedah.nama_tindakan, dbo.tc_bedah.kode_dr_bedah, dbo.tc_bedah.kode_dr_anestesi, dbo.tc_bedah.tgl_jam_masuk, 
                      dbo.tc_bedah.kode_perusahaan, dbo.tc_bedah.umur, dbo.tc_bedah.jenis_anestesi, dbo.th_riwayat_pasien.diagnosa_awal, dbo.mt_master_tarif.kode_bagian, dbo.mt_master_pasien.jen_kelamin, 
                      dbo.tc_bedah.kode_tarif, dbo.tc_bedah.kode_klas, dbo.tc_bedah.kode_kelompok, dbo.tc_trans_pelayanan.ref_bedah, dbo.tc_trans_kasir.tgl_jam, dbo.tc_bedah.tgl_jam_keluar, 
                      YEAR(dbo.tc_trans_kasir.tgl_jam)
HAVING      (dbo.mt_master_tarif.kode_bagian = '030901')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rl3_bedah_v]");
    }
};
