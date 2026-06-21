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
        DB::statement("CREATE OR ALTER VIEW dbo.pokok_dr_v
AS
SELECT     dbo.mt_karyawan.nama_pegawai, dbo.mt_bagian.nama_bagian, dbo.mt_karyawan.kode_dokter, dbo.mt_karyawan.status, dbo.mt_karyawan.no_mr, dbo.mt_jabatan.nama_jabatan, 
                      dbo.mt_karyawan.id_status, dbo.mt_karyawan.id_dc_kawin, dbo.mt_karyawan.gaji_pokok, dbo.mt_karyawan.id_sex, dbo.mt_karyawan.tlp, dbo.mt_karyawan.alamat, dbo.mt_karyawan.tmp_lahir, 
                      dbo.mt_karyawan.tgl_lahir, dbo.mt_karyawan.npp, dbo.dc_pendidikan.pendidikan, dbo.dc_riwayat_pendidikan.lokasi_sekolah, dbo.dc_riwayat_pendidikan.nama_sekolah, 
                      dbo.dc_riwayat_pendidikan.tahun_lulus, dbo.dc_sex.sex AS jen_kelamin, dbo.mt_karyawan.kode_bagian_gaji, dbo.dd_bagian_gaji.nama_bagian AS nama_bagian_gaji, dbo.mt_karyawan.no_induk, 
                      dbo.dc_agama.agama, dbo.mt_karyawan.tmt_bekerja, dbo.mt_karyawan.tinggi_Badan, dbo.mt_karyawan.berat_badan, dbo.mt_karyawan.gol_darah, dbo.mt_karyawan.suku, dbo.mt_karyawan.kota, 
                      dbo.mt_karyawan.propinsi, dbo.mt_karyawan.kode_bagian, dbo.mt_karyawan.nama_panggilan, dbo.mt_karyawan.no_rekening, dbo.mt_karyawan.nama_bank, dbo.mt_karyawan.no_ktp, 
                      dbo.mt_karyawan.no_sim, dbo.mt_karyawan.ketenagakerjaan_1, dbo.mt_karyawan.ketenagakerjaan_2, dbo.mt_karyawan.npwp, dbo.mt_karyawan.tgl_akhir_ktp, dbo.mt_karyawan.flag_aktif, 
                      dbo.mt_karyawan.STR, dbo.mt_karyawan.SIP, dbo.mt_karyawan.tgl_keluar
FROM         dbo.mt_jabatan RIGHT OUTER JOIN
                      dbo.mt_dokter_bagian INNER JOIN
                      dbo.mt_bagian ON dbo.mt_dokter_bagian.kd_bagian = dbo.mt_bagian.kode_bagian RIGHT OUTER JOIN
                      dbo.mt_karyawan ON dbo.mt_dokter_bagian.kode_dokter = dbo.mt_karyawan.kode_dokter LEFT OUTER JOIN
                      dbo.mt_spesialisasi_dokter ON dbo.mt_karyawan.kode_spesialisasi = dbo.mt_spesialisasi_dokter.kode_spesialisasi LEFT OUTER JOIN
                      dbo.dc_agama ON dbo.mt_karyawan.id_dc_agama = dbo.dc_agama.id_dc_agama LEFT OUTER JOIN
                      dbo.dd_bagian_gaji ON dbo.mt_karyawan.kode_bagian_gaji = dbo.dd_bagian_gaji.kode_bagian_gaji LEFT OUTER JOIN
                      dbo.dc_sex ON dbo.mt_karyawan.id_sex = dbo.dc_sex.id_dc_sex LEFT OUTER JOIN
                      dbo.dc_riwayat_pendidikan INNER JOIN
                      dbo.dc_pendidikan ON dbo.dc_riwayat_pendidikan.id_dc_pendidikan = dbo.dc_pendidikan.id_dc_pendidikan ON dbo.mt_karyawan.npp = dbo.dc_riwayat_pendidikan.npp ON 
                      dbo.mt_jabatan.kode_jabatan = dbo.mt_karyawan.kode_jabatan
WHERE     (dbo.mt_karyawan.kode_dokter IS NOT NULL) AND (dbo.mt_karyawan.no_induk <> 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pokok_dr_v]");
    }
};
