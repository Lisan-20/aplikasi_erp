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
        DB::statement("CREATE VIEW dbo.lap_vk_tind_v
AS
SELECT        DAY(dbo.tc_trans_pelayanan.tgl_transaksi) AS tgl, MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) AS bln, YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) AS thn, dbo.tc_kunjungan.no_kunjungan, 
                         dbo.tc_kunjungan.no_registrasi, dbo.tc_kunjungan.no_mr, dbo.tc_kunjungan.kode_dokter, dbo.tc_registrasi.stat_pasien, dbo.tc_kunjungan.status_batal, dbo.tc_registrasi.kode_kelompok, 
                         dbo.tc_kunjungan.tgl_masuk, dbo.tc_kunjungan.tgl_keluar, dbo.mt_karyawan.nama_pegawai, dbo.mt_master_pasien.almt_ttp_pasien, dbo.mt_master_pasien.tlp_almt_ttp, dbo.tc_kunjungan.kode_bagian_tujuan, 
                         dbo.tc_registrasi.umur, dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_bedah.kode_dr_bedah, dbo.tc_bedah.kode_dr_anestesi, dbo.tc_bedah.nama_tindakan, 
                         dbo.tc_registrasi.id_paket
FROM            dbo.tc_kunjungan INNER JOIN
                         dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                         dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                         dbo.tc_trans_pelayanan ON dbo.tc_kunjungan.no_kunjungan = dbo.tc_trans_pelayanan.no_kunjungan INNER JOIN
                         dbo.tc_bedah ON dbo.tc_kunjungan.no_kunjungan = dbo.tc_bedah.no_kunjungan LEFT OUTER JOIN
                         dbo.mt_karyawan ON dbo.tc_kunjungan.kode_dokter = dbo.mt_karyawan.kode_dokter
WHERE        (dbo.tc_registrasi.status_batal IS NULL)
GROUP BY DAY(dbo.tc_trans_pelayanan.tgl_transaksi), MONTH(dbo.tc_trans_pelayanan.tgl_transaksi), YEAR(dbo.tc_trans_pelayanan.tgl_transaksi), dbo.tc_kunjungan.no_kunjungan, dbo.tc_kunjungan.no_registrasi, 
                         dbo.tc_kunjungan.no_mr, dbo.tc_kunjungan.kode_dokter, dbo.tc_registrasi.stat_pasien, dbo.tc_kunjungan.status_batal, dbo.tc_registrasi.kode_kelompok, dbo.tc_kunjungan.tgl_masuk, 
                         dbo.tc_kunjungan.tgl_keluar, dbo.mt_karyawan.nama_pegawai, dbo.mt_master_pasien.almt_ttp_pasien, dbo.mt_master_pasien.tlp_almt_ttp, dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_registrasi.umur, 
                         dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_bedah.kode_dr_bedah, dbo.tc_bedah.kode_dr_anestesi, dbo.tc_bedah.nama_tindakan, dbo.tc_registrasi.id_paket
HAVING        (dbo.tc_kunjungan.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.kode_tarif IN (305010113, 305010114))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_vk_tind_v]");
    }
};
