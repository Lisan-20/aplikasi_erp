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
        DB::statement("CREATE VIEW dbo.data_pokok_pegawai_v
AS
SELECT     TOP (100) PERCENT dbo.mt_karyawan.nama_pegawai, dbo.mt_bagian.nama_bagian, dbo.mt_karyawan.kode_dokter, dbo.mt_karyawan.status, dbo.mt_karyawan.no_mr, 
                      dbo.mt_jabatan.nama_jabatan, dbo.mt_karyawan.id_status, dbo.mt_karyawan.id_dc_kawin, dbo.mt_karyawan.gaji_pokok, dbo.mt_karyawan.id_sex, dbo.mt_karyawan.tlp, dbo.mt_karyawan.alamat, 
                      dbo.mt_karyawan.tmp_lahir, dbo.mt_karyawan.tgl_lahir, dbo.mt_karyawan.npp, dbo.dc_pendidikan.pendidikan, dbo.dc_riwayat_pendidikan.lokasi_sekolah, 
                      dbo.dc_riwayat_pendidikan.nama_sekolah, dbo.dc_riwayat_pendidikan.tahun_lulus, dbo.dc_sex.sex AS jen_kelamin, dbo.mt_karyawan.kode_bagian_gaji, 
                      dbo.dd_bagian_gaji.nama_bagian AS nama_bagian_gaji, dbo.mt_karyawan.no_induk, dbo.dc_agama.agama, dbo.mt_karyawan.tmt_bekerja, dbo.mt_karyawan.tinggi_Badan, 
                      dbo.mt_karyawan.berat_badan, dbo.mt_karyawan.gol_darah, dbo.mt_karyawan.suku, dbo.mt_karyawan.kota, dbo.mt_karyawan.propinsi, dbo.mt_karyawan.kode_bagian, 
                      dbo.mt_karyawan.nama_panggilan, dbo.mt_karyawan.no_rekening, dbo.mt_karyawan.nama_bank, dbo.mt_karyawan.no_ktp, dbo.mt_karyawan.no_sim, dbo.mt_karyawan.ketenagakerjaan_1, 
                      dbo.mt_karyawan.ketenagakerjaan_2, dbo.mt_karyawan.npwp, dbo.mt_karyawan.tgl_akhir_ktp, dbo.mt_karyawan.ko_wil, dbo.dc_riwayat_pendidikan.id_dc_pendidikan, 
                      dbo.mt_karyawan.tgl_berubah_status, dbo.mt_karyawan.STR, dbo.mt_karyawan.SIP, dbo.mt_karyawan.grup_penilaian, dbo.mt_karyawan.keterangan, dbo.mt_karyawan.st_shift, 
                      dbo.mt_karyawan.ttd, dbo.mt_karyawan.tgl_ttd, dbo.mt_karyawan.flag_aktif, dbo.mt_jabatan.kode_kel_kerja
FROM         dbo.dc_agama RIGHT OUTER JOIN
                      dbo.mt_karyawan ON dbo.dc_agama.id_dc_agama = dbo.mt_karyawan.id_dc_agama LEFT OUTER JOIN
                      dbo.dd_bagian_gaji ON dbo.mt_karyawan.kode_bagian_gaji = dbo.dd_bagian_gaji.kode_bagian_gaji LEFT OUTER JOIN
                      dbo.dc_sex ON dbo.mt_karyawan.id_sex = dbo.dc_sex.id_dc_sex LEFT OUTER JOIN
                      dbo.dc_riwayat_pendidikan INNER JOIN
                      dbo.dc_pendidikan ON dbo.dc_riwayat_pendidikan.id_dc_pendidikan = dbo.dc_pendidikan.id_dc_pendidikan ON dbo.mt_karyawan.npp = dbo.dc_riwayat_pendidikan.npp LEFT OUTER JOIN
                      dbo.mt_bagian ON dbo.mt_karyawan.kode_bagian = dbo.mt_bagian.kode_bagian LEFT OUTER JOIN
                      dbo.mt_jabatan ON dbo.mt_karyawan.kode_jabatan = dbo.mt_jabatan.kode_jabatan
WHERE     (NOT (dbo.mt_karyawan.no_induk IN (1, 666)))
ORDER BY dbo.mt_karyawan.nama_pegawai
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [data_pokok_pegawai_v]");
    }
};
