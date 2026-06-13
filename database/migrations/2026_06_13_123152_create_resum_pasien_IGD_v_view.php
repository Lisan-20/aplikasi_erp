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
        DB::statement("CREATE OR ALTER VIEW dbo.resum_pasien_IGD_v
AS
SELECT     dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.no_registrasi, dbo.tc_trans_kasir.no_mr, dbo.tc_trans_kasir.tgl_jam, dbo.tc_registrasi.kode_kelompok, 
                      dbo.tc_registrasi.kode_perusahaan, dbo.tc_trans_kasir.nama_pasien, dbo.tc_trans_kasir.status_batal, dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_registrasi.ft_coding, 
                      dbo.tc_registrasi.ft_pengantar, dbo.tc_registrasi.ft_sep, dbo.mt_master_pasien.ft_kartu, dbo.mt_master_pasien.ft_kartu_keluarga, dbo.mt_master_pasien.ft_ktp, dbo.tc_registrasi.noSep, 
                      dbo.tc_registrasi.ttd, YEAR(dbo.tc_trans_kasir.tgl_jam) AS Expr1, dbo.tc_registrasi.kode_bagian_masuk, dbo.tc_trans_kasir.tgl_ver_berkas, dbo.tc_trans_kasir.flag_ver_berkas, 
                      dbo.mt_bagian.nama_bagian, dbo.mt_karyawan.nama_pegawai AS nama_dokter, dbo.tc_registrasi.id_triase_identitas
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_kasir.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_trans_kasir.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.mt_bagian ON dbo.tc_registrasi.kode_bagian_masuk = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_registrasi.kode_dokter = dbo.mt_karyawan.kode_dokter INNER JOIN
                      dbo.tc_emr_form_igd_v ON dbo.tc_registrasi.no_registrasi = dbo.tc_emr_form_igd_v.no_registrasi
WHERE     (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_trans_kasir.seri_kuitansi = 'AJ') AND (dbo.tc_registrasi.kode_kelompok NOT IN (1, 5, 3)) AND (YEAR(dbo.tc_trans_kasir.tgl_jam) >= 2023) AND 
                      (dbo.tc_registrasi.kode_bagian_masuk = '020101')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [resum_pasien_IGD_v]");
    }
};
