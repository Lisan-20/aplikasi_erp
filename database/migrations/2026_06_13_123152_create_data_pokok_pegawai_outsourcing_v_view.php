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
        DB::statement("CREATE VIEW dbo.data_pokok_pegawai_outsourcing_v
AS
SELECT     TOP (100) PERCENT dbo.mt_bagian.nama_bagian, dbo.mt_jabatan.nama_jabatan, dbo.dc_pendidikan.pendidikan, dbo.dc_riwayat_pendidikan.lokasi_sekolah, 
                      dbo.dc_riwayat_pendidikan.nama_sekolah, dbo.dc_riwayat_pendidikan.tahun_lulus, dbo.dc_sex.sex AS jen_kelamin, dbo.dd_bagian_gaji.nama_bagian AS nama_bagian_gaji, 
                      dbo.dc_agama.agama, dbo.dc_riwayat_pendidikan.id_dc_pendidikan, dbo.mt_karyawan_outsourcing.id_sex, dbo.mt_karyawan_outsourcing.id_status, dbo.mt_karyawan_outsourcing.id_dc_kawin, 
                      dbo.mt_karyawan_outsourcing.gaji_pokok, dbo.mt_karyawan_outsourcing.nama_bank, dbo.mt_karyawan_outsourcing.no_rekening, dbo.mt_karyawan_outsourcing.tgl_lahir, 
                      dbo.mt_karyawan_outsourcing.tmp_lahir, dbo.mt_karyawan_outsourcing.tlp, dbo.mt_karyawan_outsourcing.no_mr, dbo.mt_karyawan_outsourcing.status, 
                      dbo.mt_karyawan_outsourcing.kode_dokter, dbo.mt_karyawan_outsourcing.nama_pegawai, dbo.mt_karyawan_outsourcing.no_induk, dbo.mt_karyawan_outsourcing.alamat, 
                      dbo.mt_karyawan_outsourcing.tmt_bekerja, dbo.mt_karyawan_outsourcing.tinggi_Badan, dbo.mt_karyawan_outsourcing.berat_badan, dbo.mt_karyawan_outsourcing.gol_darah, 
                      dbo.mt_karyawan_outsourcing.suku, dbo.mt_karyawan_outsourcing.kota, dbo.mt_karyawan_outsourcing.propinsi, dbo.mt_karyawan_outsourcing.nama_panggilan, 
                      dbo.mt_karyawan_outsourcing.no_ktp, dbo.mt_karyawan_outsourcing.no_sim, dbo.mt_karyawan_outsourcing.ketenagakerjaan_1, dbo.mt_karyawan_outsourcing.ketenagakerjaan_2, 
                      dbo.mt_karyawan_outsourcing.npwp, dbo.mt_karyawan_outsourcing.tgl_akhir_ktp, dbo.mt_karyawan_outsourcing.ko_wil, dbo.mt_karyawan_outsourcing.npp, 
                      dbo.mt_karyawan_outsourcing.tgl_berubah_status, dbo.mt_karyawan_outsourcing.STR, dbo.mt_karyawan_outsourcing.SIP, dbo.mt_karyawan_outsourcing.grup_penilaian, 
                      dbo.mt_karyawan_outsourcing.keterangan, dbo.mt_karyawan_outsourcing.kode_bagian, dbo.mt_karyawan_outsourcing.tgl_keluar
FROM         dbo.dc_riwayat_pendidikan INNER JOIN
                      dbo.dc_pendidikan ON dbo.dc_riwayat_pendidikan.id_dc_pendidikan = dbo.dc_pendidikan.id_dc_pendidikan RIGHT OUTER JOIN
                      dbo.mt_karyawan_outsourcing ON dbo.dc_riwayat_pendidikan.npp = dbo.mt_karyawan_outsourcing.npp LEFT OUTER JOIN
                      dbo.dc_agama ON dbo.mt_karyawan_outsourcing.id_dc_agama = dbo.dc_agama.id_dc_agama LEFT OUTER JOIN
                      dbo.dd_bagian_gaji ON dbo.mt_karyawan_outsourcing.kode_bagian_gaji = dbo.dd_bagian_gaji.kode_bagian_gaji LEFT OUTER JOIN
                      dbo.dc_sex ON dbo.mt_karyawan_outsourcing.id_sex = dbo.dc_sex.id_dc_sex LEFT OUTER JOIN
                      dbo.mt_bagian ON dbo.mt_karyawan_outsourcing.kode_bagian = dbo.mt_bagian.kode_bagian LEFT OUTER JOIN
                      dbo.mt_jabatan ON dbo.mt_karyawan_outsourcing.kode_jabatan = dbo.mt_jabatan.kode_jabatan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [data_pokok_pegawai_outsourcing_v]");
    }
};
